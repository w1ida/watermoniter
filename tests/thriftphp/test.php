<?php  
/** 
 * Created by PhpStorm. 
 * User: ss 
 * Date: 16-6-21 
 * Time: 下午11:43 
 */  
//echo $view->htmlError();  
  
ini_set('display_errors', E_ALL);  
$GLOBALS['THRIFT_ROOT'] = "./lib";  
//phpinfo()&&exit();  
  
/* Dependencies. In the proper order. */  
require_once $GLOBALS['THRIFT_ROOT'] . '/Thrift/Transport/TTransport.php';  
require_once $GLOBALS['THRIFT_ROOT'] . '/Thrift/Transport/TSocket.php';  
require_once $GLOBALS['THRIFT_ROOT'] . '/Thrift/Protocol/TProtocol.php';  
require_once $GLOBALS['THRIFT_ROOT'] . '/Thrift/Protocol/TBinaryProtocol.php';  
require_once $GLOBALS['THRIFT_ROOT'] . '/Thrift/Protocol/TBinaryProtocolAccelerated.php';  
require_once $GLOBALS['THRIFT_ROOT'] . '/Thrift/Transport/TBufferedTransport.php';  
require_once $GLOBALS['THRIFT_ROOT'] . '/Thrift/Type/TMessageType.php';  
require_once $GLOBALS['THRIFT_ROOT'] . '/Thrift/Factory/TStringFuncFactory.php';  
require_once $GLOBALS['THRIFT_ROOT'] . '/Thrift/StringFunc/TStringFunc.php';  
require_once $GLOBALS['THRIFT_ROOT'] . '/Thrift/StringFunc/Core.php';  
require_once $GLOBALS['THRIFT_ROOT'] . '/Thrift/Type/TType.php';  
require_once $GLOBALS['THRIFT_ROOT'] . '/Thrift/Exception/TException.php';  
require_once $GLOBALS['THRIFT_ROOT'] . '/Thrift/Exception/TTransportException.php';  
require_once $GLOBALS['THRIFT_ROOT'] . '/Thrift/Exception/TProtocolException.php';  
  
  
/* Remember these two files? */  
//require_once($GLOBALS['THRIFT_ROOT'] . '/gen-php/THBaseService.php');  
//require_once($GLOBALS['THRIFT_ROOT'] . '/gen-php/Types.php');  
require_once $GLOBALS['THRIFT_ROOT'] . '/Types.php';  
require_once $GLOBALS['THRIFT_ROOT'] . '/Hbase.php';  
  
use Thrift\Protocol\TBinaryProtocol;  
  
use Thrift\Transport\TBufferedTransport;  
  
  
use Thrift\Transport\TSocket;  
use Hbase\HbaseClient;  
use Hbase\ColumnDescriptor;  
use Hbase\Mutation;  
  
function printRow($rowresult)  
{  
    if (isset($rowresult)) {  
        echo("row: {$rowresult->row}, cols: \n");  
        $values = $rowresult->columns;  
        asort($values);  
        foreach ($values as $k => $v) {  
            echo("  {$k} => {$v->value}\n");  
        }  
    }  
  
}  
 
  

//define host and port  
    $host = '127.0.0.1';  
    $port = 9090;  
  
    $tablename = "water";  
  
    $socket = new Thrift\Transport\TSocket($host, $port);  
  
    $socket->setSendTimeout(10000); // Ten seconds (too long for production, but this is just a demo ;)  
    $socket->setRecvTimeout(20000); // Twenty seconds  
  
    $transport = new TBufferedTransport($socket);  
    $protocol = new \Thrift\Protocol\TBinaryProtocolAccelerated($transport);  
  
    $client = new \Hbase\HbaseClient($protocol);  
  
    $transport->open();  
    echo 'tables:<br>';

	// $descriptors = $client->getColumnDescriptors($tablename);  
	// asort($descriptors);  
	// foreach($descriptors as $col){  
	// var_dump("column:{$col->name},maxVer: {$col->maxVersions}");  
	// }  
  
  
 // echo 'view table success';
   
  
  
     $tables = $client->getTableNames();  
       sort($tables);  
  
    foreach ($tables as $name) {  
        echo $name . "</br>";  
        $t = "";  
        if($name == $tablename){  
            if($client->isTableEnabled($name)){  
                echo (" disabling table: {$name}"."</br>");  
                $client->disableTable($name);  
            }  
           // echo (" deleting table: {$name}"."</br>");  
           // $client->deleteTable($name);  
        }  
  
    }  
  
  /*
  //查看table  
    $tables = $client->getTableNames();  
     //   sort($tables);  
  
    foreach ($tables as $name) {  
        echo $name . "</br>";  
        $t = "";  
        if($name == $tablename){  
            if($client->isTableEnabled($name)){  
                echo (" disabling table: {$name}"."</br>");  
                $client->disableTable($name);  
            }  
            echo (" deleting table: {$name}"."</br>");  
            $client->deleteTable($name);  
        }  
  
    }  
	
	echo 'view table success';
    //新建table  
    $columns = array(  
        new \Hbase\ColumnDescriptor(array(  
            'name'=>'id:',  
            'maxVersions'=>10  
        )),  
        new \Hbase\ColumnDescriptor(array(  
            'name'=>'name:',  
            'maxVersions'=>10  
        )),  
        new \Hbase\ColumnDescriptor(array(  
            'name'=>'score:',  
            'maxVersions'=>10  
        ))  
  
    );  
  
  
    try{  
        $client->createTable($tablename,$columns);  
    }catch (\Hbase\AlreadyExists $ae)  
    {  
        var_dump("WARN: ($ae->message)\n");  
    }  
  
  
    //get table descriptors  
    $descriptors = $client->getColumnDescriptors($tablename);  
    asort($descriptors);  
    foreach($descriptors as $col){  
        var_dump("column:{$col->name},maxVer: {$col->maxVersions}");  
    }  
  
  
  
    //set column  
    //add update column data  
    $time = time();  
//    var_dump($time);  
  
    $row = '2';  
    $valid = "foobar-".$time;  
  
    $dummy_attributes = array();  
  
  
    //test UTF-8 handling  
    $invalid = "foo-\xfc\xa1\xa1\xa1\xa1\xa1";  
    $valid = "foo-\xE7\x94\x9F\xe3\x83\x93\xe3\x83\xbc\xe3\x83\xa8";  
  
  
    //not utf-8 is fine for data  
    $mutations = array(  
        new \Hbase\Mutation(  
            array(  
                'column'=>'id:foo',  
                'value'=>$invalid  
            )  
        )  
  
    );  
    $client->mutateRow($tablename,"foo",$mutations,$dummy_attributes);  
  
  
    $mutations = array(  
        new \Hbase\Mutation(  
            array(  
                'column'=>'id:foo',  
                'value'=>$valid  
            )  
        )  
  
    );  
    $client->mutateRow($tablename,$valid,$mutations,$dummy_attributes);  
  
  
  
    //non-utf8 is not allowed in row names  
//    try{  
//        $mutations = array(  
//            new \Hbase\Mutation(  
//                array(  
//                    'column'=>'id:foo',  
//                    'value'=>$invalid  
//                )  
//            )  
//  
//        );  
//        $client->mutateRow($tablename,$invalid,$mutations,$dummy_attributes);  
//    }catch (\Hbase\IOError $e)  
//    {  
//        echo ("except error : {$e->message}");  
//    }  
  
  
    $arry = $client->get($tablename,"foo","id:foo",$dummy_attributes);  
  
    foreach($arry as $k =>$v){  
  
//        echo "------get one : key = {$k}"."</br>";  
        echo "------get one : value = {$v->value}"."</br>";  
        echo "------get one : timestamp = {$v->timestamp}"."</br>";  
    }  
  
//    $client->deleteAll($tablename,"foo","id:foo",$dummy_attributes);  
  
  
    echo ("Starting scanner..."."</br>");  
  
    $scanner = $client->scannerOpen($tablename,"foo",array("id:foo"),$dummy_attributes);  
    try{  
        $values = $client->scannerGet($scanner);  
        print_r($values);  
  
    }catch (Exception $e){  
        $client->scannerClose($scanner);  
        echo ("Scaner finished"."</br>");  
    }  
  
    $transport->close();  
  
} catch (Exception $e) {  
    echo "Exception: $e\r\n";  
}  
  */
