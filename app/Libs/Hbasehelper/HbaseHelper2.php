<?php
namespace Hbasehelper2;

ini_set('display_errors', E_ALL);  

require_once __DIR__.'/lib/Thrift/ClassLoader/ThriftClassLoader.php'; 

use Thrift\ClassLoader\ThriftClassLoader;
$GEN_DIR = realpath(dirname(__FILE__)).'/lib';
// echo $GEN_DIR.PHP_EOL;
$loader = new ThriftClassLoader();
$loader->registerNamespace('Thrift', __DIR__ . '/lib');
$loader->register();
use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TSocket;
use Thrift\Transport\THttpClient;
use Thrift\Transport\TBufferedTransport;
use Thrift\Exception\TException;
require_once $GEN_DIR.'/THBaseService.php'; 
require_once $GEN_DIR.'/Types2.php'; 

class Hbasehelper2{
	public $host = '115.159.34.190';
	public $port = '9090';
	public $socket;
	public $transport;
	public $client;
	public $table="water";
	function __construct(){
		try{
			$this->socket = new TSocket( $this->host, $this->port);
			$this->socket->setSendTimeout (10000); 
			$this->socket->setRecvTimeout (20000); 
			$this->transport = new TBufferedTransport ($this->socket);
			$this->protocol = new TBinaryProtocol ($this->transport);
			$this->client = new \THBaseServiceClient($this->protocol);
			$this->transport->open ();
			// $this->scan();
			//$this->write();
		}
		catch (TException $tx){
			print 'TException: '.$tx->__toString(). ' Error: '.$tx->getMessage() . "\n";
		}
	}


    public static function TColumnValue($arr){
        return new \TColumnValue($arr);
    }

	public function get($table_name,$row,$statr=0,$end=99999999999999){
		
		$tget=new \TGet([
			'row' => $row,
			 'timeRange' => new \TTimeRange(['minStamp'=>$statr,'maxStamp'=>$end]),
			'maxVersions' => 22147483647,
		]);
		$data=$this->client->get($table_name,$tget);
		return $data->columnValues;
	}
	
	public function scan($table_name){
		// $columns = array("t");
		$tc = new \TColumn(array(
			'family'=>'data',
			'qualifier'=>'a'
		));
		
		$tscan = new \TScan( [
		
		'maxVersions'	=> 22147483647,
		'timeRange'	=> new \TTimeRange(['minStamp'=>0,'maxStamp'=>99999999999999]),
		// 'startRow'		=> '',
		// 'columns'		=> array($tc),
		// 'filterString' 	=> "PrefixFilter('1438041602')",
		] );
		$scanner = $this->client->openScanner( $table_name,  $tscan);
		try {
			while (true){
				$get_arr = $this->client->getScannerRows( $scanner,1);
				if($get_arr == null){break;}
				echo json_encode($get_arr);
				exit();
				
				//$this->printRow( $get_arr[0] );
			}     
		} catch ( NotFound $nf ) {
			$this->client->scannerClose( $scanner );
			echo( "Scanner finished\n" );
		}
	}
	
	
	public function put($table_name){
		$tput = new \TPut([
			'row' => '000000' ,
			'columnValues' => [ new \TColumnValue ([ 
				'family' => 'data', 
				'qualifier' => 'a',
				'value' => '999',
				// 'timestamp' => 1 //timestamp
			])],
			'timestamp' => 1,
		]);
		// $value1 = $res[1];
		// $key = sprintf("%s%s",$res[0],$res[3]);
		$this->client->put( $table_name, $tput);
	}
	
	public function insert($table_name){
		$mutations = new \TRowMutations([
		'row' => '000000',
		'mutations' => 
			[new \TMutation( [
				'column' => 'data:a',
				'value' => '112',
				// 'versions' => 3
			] )]
		])
		;
		$this->client->mutateRow( $table_name,  $mutations);
		
	}
	
	public function write(){
		$f = fopen("url.log","r");
		while (($line = fgets($f)) !== false) {
			$line = trim($line);
			if (empty($line)) {
				continue;
			}   
			$res = explode("\t",$line);
			insert($res);
		}   
	}
	
	
	function printRow( $rowresult ) {
		echo( "row: {$rowresult->row}, cols: \n" );
		$values = $rowresult->columnValues;
		asort( $values );
		foreach ( $values as $k=>$v ) {
			echo( "  {$k} => {$v->value}\n" );
		}
	}

}