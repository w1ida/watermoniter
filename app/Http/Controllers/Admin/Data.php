<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Hbasehelper\Hbasehelper;
use Hbasehelper\Hbasehelper2;

class Data extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth',['except' => '']);
    }
    public function index(Request $request,$pid){
        $this->middleware('auth',['except' => '']);
        $user = $request->user();
        return view('admin.admin_data',['user'=>$user ,'pid'=>$pid]);
    }
	
	public function ajaxdata(Request $request,$pid){
	
		$hdb2=new \Hbasehelper2\Hbasehelper2();
		
		$data=$hdb2->get('water',"$pid",$request->query->get('stime'),$request->query->get('etime'));
		$arr=[];
		foreach($data as $row){
			$timestamp=doubleval($row->timestamp)/1000;
			$arr[$timestamp][$row->qualifier]=$row->value;
		}
		$out=[];
        $columns=[];
		foreach($arr as $key=>$row){
			unset($tmp);
			$tmp[]=date('Y-m-d H:i',$key);
			foreach($row as $k=>$v){
                $columns[$k]=$this->t($k);
				$tmp[]=floatval($v);
			}
			$out[]=$tmp;
		}
		// ksort($arr);
        $columns2[0]=(object)['title'=>'时间'];
        foreach ($columns as $row){
            $columns2[]=(object)['title'=>$row];
        }
		echo json_encode(['data'=>$out,'columns'=>$columns2]);
		//dd($arr);
	}
	
	

	public function analysis(Request $request,$pid){
		$user = $request->user();
		return view('admin.admin_data_analysis	')->with( ['user'=>$user,'pid'=>$pid]);
	}
	
	public function ajaxanalysis(Request $request,$pid){
		// dd($pid);
		//return '';
		$hdb2=new \Hbasehelper2\Hbasehelper2();
		
		$data=$hdb2->get('water',"$pid",$request->query->get('stime'),$request->query->get('etime'));
		$arr=[];
		foreach($data as $row){
			$timestamp=doubleval($row->timestamp)/1000;
			$arr[$timestamp][$row->qualifier]=$row->value;
		}
		$PL=86400;
		$out=[];
		foreach($arr as $key=>$val){
			$xb=intval($key/$PL);
			if(isset($out[$xb])){
				$tmp=$out[$xb];
			}else{
				foreach($val as $k=>$v){
					$tmp[$k]=[
						'sum'=>0,
						'cnt'=>0,
					];
				}
			}
			foreach($val as $k=>$v){
				$tmp[$k]['sum']+=(double)$v;
				$tmp[$k]['cnt']+=1;
			}
			$out[$xb]=$tmp;
		}
		$date=[];
		$data=[];
		ksort($out);
		foreach($out as $key=>$val){
			$tmp=[];
			foreach($val as $k=>$v){
				$data[$this->t($k)][]=round($v['sum']/$v['cnt'],8);
			}
			$date[]=date('Y-m-d',$key*86400);
		}
		$out=[
			'date'=>$date,
			'data'=>$data,
		];
		return json_encode($out);
	}
	
	public function t($bq){
		$remark=['zg'=>'镉',
				 'zq'=>'铅',
				 'zt'=>'铜',
				 'zx'=>'锌',
				 'zs'=>'砷',
				 'temp'=>'温度',
				 't'=>'浊度',
		 ];
		 if(isset($remark[$bq]))
			return $remark[$bq];
		return $bq;
	}
	
	public function jsonapi(){
		//ksort($arr);
	//	dd($data);
		//dd($data);
		
		
		// $client=$hdb2->client;
		
		return ;
		
		// $hdb=new Hbasehelper();
		// $client=$hdb->client;
		
		// dd($client->getRowWithColumnsTs('water','000000',['data:a','data:b'],99999999999999,['versions'=>3]));
		// dd($hdb->get('water','000000','data',''));
		//$hdb->delTable('shui');
		//dd($client->getTableNames());
		//$arry = $client->get('t2','tzh','f1',[  'VERSIONS' =>3, 'TIMERANGE'=>'[0,9999999999999]' ]);  
		// $data=$client->getVer('')
		  // dd($arry);
		return null;
	}
	
	public function import(){
        exit(__FILE__);
		$hdb2=new \Hbasehelper2\Hbasehelper2();
		
		// $hdb2->socket->setSendTimeout (100000); 
		// $hdb2->socket->setRecvTimeout (200000); 
		
		$file=file_get_contents("D:\+code\PHP\watermoniter\app\Http\Controllers\Admin\a.txt");
		$data=explode("\n",$file);
		
		foreach($data as $row){
			break;
			$t=explode("\t",$row);
			if(count($t)!==6)continue;
			$t[5]=(double)$t[5];
			$cols=[];
			$cols[]=new \TColumnValue ([ 
				'family'	=> 'data', 
				'qualifier'	=> 'zg', 
				'value'		=> $t[0],
				'timestamp' => $t[5],
			]);
			 // dd($cols);
			$cols[]=new \TColumnValue ([ 
				'family'	=> 'data', 
				'qualifier'	=> 'zq', 
				'value'		=> $t[1],
				'timestamp' => $t[5],
			]);
			$cols[]=new \TColumnValue ([ 
				'family'	=> 'data', 
				'qualifier'	=> 'zt', 
				'value'		=> $t[2],
				'timestamp' => $t[5],
			]);
			$cols[]=new \TColumnValue ([ 
				'family'	=> 'data', 
				'qualifier'	=> 'zx', 
				'value'		=> $t[3],
				'timestamp' => $t[5],
			]);
			$cols[]=new \TColumnValue ([ 
				'family'	=> 'data', 
				'qualifier'	=> 'zs', 
				'value'		=> $t[4],
				'timestamp' => $t[5],
			]);
			$tput = new \TPut([
				'row' => '15' ,
				'columnValues' => $cols,
				'timestamp' => $t[5],
			]);

			
			$hdb2->client->put( 'water', $tput);
			// dd($tput);
		}

	}
}
