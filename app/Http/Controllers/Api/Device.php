<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hbasehelper\Hbasehelper;
use Mockery\Exception;

//use Hbasehelper\Hbasehelper2;

class Device extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth',['except' => '']);
    }

    public function index(Request $request){
        $user = $request->user();
        return view('admin.admin_data',['user'=>$user ]);
    }

    public function saveData(Request $request,$did){
        try {
            $data=$request->only(['t','temp','ph']);
            $hdb2 = new \Hbasehelper2\Hbasehelper2();
            $cols = [];
            if(isset($request->time))$time=$request->time;
            else $time = time() * 1000;
            foreach ($data as $k=>$v)
            {
                $cols[] = new \TColumnValue ([
                    'family' => 'data',
                    'qualifier' => $k,
                    'value' => $v,
                    'timestamp' => $time,
                ]);
                //var_dump($k.$v);
            }
            $tput = new \TPut([
                'row' => $did,
                'columnValues' => $cols,
                'timestamp' => $time,
            ]);
            $res = $hdb2->client->put('water', $tput);
            return "did:${did} stored.";
        }catch (Exception $e){
            return "did:${did} store failed.";
        }
    }


    public function import(){
        exit(__FILE__);
        $hdb2=new \Hbasehelper2\Hbasehelper2();

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
            newColumn();
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
