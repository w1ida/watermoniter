<?php
namespace Hbasehelper;

ini_set('display_errors', E_ALL);  
$GLOBALS['THRIFT_ROOT'] = "lib";  
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

require_once $GLOBALS['THRIFT_ROOT'] . '/Types.php';  
require_once $GLOBALS['THRIFT_ROOT'] . '/Hbase.php';  

use Thrift\Protocol\TBinaryProtocol;    
use Thrift\Transport\TBufferedTransport;  
use Thrift\Transport\TSocket;  
use Thrift\Protocol\TBinaryProtocolAccelerated;
use Hbase\HbaseClient;  
use Hbase\ColumnDescriptor;  
use Hbase\Mutation;  

class Hbasehelper{
	public $host = '127.0.0.1';
	public $port = '9090';
	public $socket;
	public $transport;
	public $client;
	function __construct(){
		$this->host=config('database.connections')['hbase']['host'];
		$this->port=config('database.connections')['hbase']['port'];
		$this->socket = new TSocket($this->host, $this->port);  
		$this->socket->setSendTimeout(10000); 
		$this->socket->setRecvTimeout(20000); 
		$this->transport = new TBufferedTransport($this->socket);  
		$this->protocol = new TBinaryProtocolAccelerated($this->transport);  
		$this->client = new HbaseClient($this->protocol);  
		$this->transport->open();  
	}
	
	function delTable($name){
		try{
			$this->client->disableTable($name);  
			$this->client->deleteTable($name);
		}catch(Exception $e){
			return false;
		}
		return true;
	}
	
	function get($table_name,$row,$col,$attr){
		# Run a scanner on the rows we just created
		//echo( "Starting scanner...\n" );
		$scan = new \Hbase\TScan();  
		$scan->filterString="TimestampsFilter(0,9999999999999999)";  
		$scanner = $this->client->scannerOpenWithScan($table_name, $scan,[]);  

		while(true) {  
			$get_arr = $this->client->scannerGetList($scanner,1);  
			if(!$get_arr) break;  
			dd($get_arr);
			// foreach ( $get_arr as $rowresult ){  
				// foreach ($rowresult as $k=>$item) {  
					// echo "row: ".$rowresult->{'row'}."\n";  
					// echo "cols: ";  
					// print_r($rowresult->{'columns'} );  
					// echo "-----\n";  
				// }  
			// }  
		}  
		//$this->client->scannerClose($scan );  
	}
	
	function getVer($table_name,$rowkey,$col,$maxver){
		return $arry = $this->client->getVer($table_name,$rowkey,$col,$maxver,array()); 
	}
}