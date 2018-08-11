<?php
/**
 * Created by PhpStorm.
 * User: dksx
 * Date: 2018/4/4
 * Time: 10:09
 */
import();
//调用导入函数
//导入函数
function import(){

    $hdb2=new \Hbasehelper2\Hbasehelper2();

    // $hdb2->socket->setSendTimeout (100000);
    // $hdb2->socket->setRecvTimeout (200000);

    //water
    $file=file_get_contents("a.txt");
    $data=explode("\n",$file);

    //var_dump($data);
    foreach($data as $row){

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

        //var_dump();
        // echo $t[5];

        $hdb2->client->put( 'water', $tput);
        // dd($tput);
//		break;
    }
}
