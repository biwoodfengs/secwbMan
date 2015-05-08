<?php namespace leancloud;
require_once( 'AVConfig.php' );
require_once( 'AVObject.php' );
require_once( 'AVQuery.php' );
require_once( 'AVUser.php' ) ;
require_once( 'AVFile.php' );
require_once( 'AVPush.php' );
require_once( 'AVGeoPoint.php' );
require_once( 'AVACL.php' );
require_once( 'AVCloud.php' );

class AVRestClient{

	private $_appid = '';
	private $_masterkey = '';
	private $_appkey = '';
	private $_AVurl = '';

	public $data;
	public $requestUrl = '';
	public $returnData = '';

	public function __construct(){
		$AVConfig = new AVConfig;
		$this->_appid = $AVConfig::APPID;
    	$this->_masterkey = $AVConfig::MASTERKEY;
    	$this->_appkey = $AVConfig::APPKEY;
    	$this->_AVurl = $AVConfig::AVOSCLOUDURL;

		if(empty($this->_appid) || empty($this->_appkey) || empty($this->_masterkey)){
			$this->throwError('You must set your Application ID, Master Key and Application Key');
		}

		$version = curl_version();
		$ssl_supported = ( $version['features'] & CURL_VERSION_SSL );

		if(!$ssl_supported){
			$this->throwError('CURL ssl support not found');
		}

	}

	/*
	 * All requests go through this function
	 *
	 *
	 */
	public function request($args){
		$isFile = false;
		$cacert = getcwd().'\cacert.pem'; // download cacert.pem from http://curl.haxx.se/docs/caextract.html and paste it in this folder
		$c = curl_init();
		curl_setopt($c, CURLOPT_TIMEOUT, 30);
		curl_setopt($c, CURLOPT_USERAGENT, 'AVOSCloud.com-php-library/2.0');
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($c, CURLINFO_HEADER_OUT, true);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER, true); // enable using SSL to access https
		curl_setopt($c, CURLOPT_CAINFO, $cacert);
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 2);
		if(substr($args['requestUrl'],0,5) == 'files'){
			curl_setopt($c, CURLOPT_HTTPHEADER, array(
				'Content-Type: '.$args['contentType'],
				'X-AVOSCloud-Application-Id: '.$this->_appid,
				'X-AVOSCloud-Master-Key: '.$this->_masterkey
			));
			$isFile = true;
		}
		else if(substr($args['requestUrl'],0,5) == 'users' && isset($args['sessionToken'])){
			curl_setopt($c, CURLOPT_HTTPHEADER, array(
    			'Content-Type: application/json',
    			'X-AVOSCloud-Application-Id: '.$this->_appid,
    			'X-AVOSCloud-Application-Key: '.$this->_appkey,
    			'X-AVOSCloud-Session-Token: '.$args['sessionToken']
    		));
		}
		else{
			curl_setopt($c, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'X-AVOSCloud-Application-Id: '.$this->_appid,
				'X-AVOSCloud-Application-Key: '.$this->_appkey,
				'X-AVOSCloud-Master-Key: '.$this->_masterkey
			));
		}
		curl_setopt($c, CURLOPT_CUSTOMREQUEST, $args['method']);
		$url = $this->_AVurl . $args['requestUrl'];

		if($args['method'] == 'PUT' || $args['method'] == 'POST'){
			if($isFile){
				$postData = $args['data'];
			}
			else{
				$postData = json_encode($args['data']);
			}

			curl_setopt($c, CURLOPT_POSTFIELDS, $postData );
		}

		if($args['requestUrl'] == 'login'){
			$urlParams = http_build_query($args['data'], '', '&');
			$url = $url.'?'.$urlParams;
		}

		if(array_key_exists('urlParams',$args)){
			$urlParams = http_build_query($args['urlParams'], '', '&');
    		$url = $url.'?'.$urlParams;
		}

		curl_setopt($c, CURLOPT_URL, $url);

		$response = curl_exec($c);
		$responseCode = curl_getinfo($c, CURLINFO_HTTP_CODE);

		$expectedCode = array('200');
		if($args['method'] == 'POST' && substr($args['requestUrl'],0,4) != 'push'){
			// checking if it is not cloud code - it returns code 200
			if(substr($args['requestUrl'],0,9) != 'functions'){
				$expectedCode = array('200','201');
			}
		}

		//BELOW HELPS WITH DEBUGGING

		// if(!in_array($responseCode,$expectedCode)){
			// print_r($response);
			// var_dump("pp");
			// print_r($args);

		// }
		return $this->checkResponse($response,$responseCode,$expectedCode);
	}

	public function dataType($type,$params){
		if($type != ''){
			switch($type){
				case 'date':
					$return = array(
						"__type" => "Date",
						"iso" => date("c", strtotime($params." UTC"))
					);
					break;
				case 'bytes':
					$return = array(
						"__type" => "Bytes",
						"base64" => base64_encode($params)
					);
					break;
				case 'pointer':
					$return = array(
						"__type" => "Pointer",
						"className" => $params[0],
						"objectId" => $params[1]
					);
					break;
				case 'geopoint':
					$return = array(
						"__type" => "GeoPoint",
						"latitude" => floatval($params[0]),
						"longitude" => floatval($params[1])
					);
					break;
				case 'file':
					$return = array(
						"__type" => "File",
						"id" => $params,
					);
					break;
				case 'increment':
					$return = array(
						"__op" => "Increment",
						"amount" => $params
					);
					break;
				case 'decrement':
					$return = array(
						"__op" => "Decrement",
						"amount" => $params
					);
					break;
				default:
					$return = false;
					break;
			}

			return $return;
		}
	}

	public function throwError($msg,$code=0){
		throw new AVLibraryException($msg,$code);
	}

	private function checkResponse($response,$responseCode,$expectedCode){
		//TODO: Need to also check for response for a correct result from AVOSCloud.com
		if(!in_array($responseCode,$expectedCode)){
			$error = json_decode($response);
			//$this->throwError($error->error,$error->code);
		}
		else{
			//check for empty return
			if($response == '{}'){
				return true;
			}
			else{
				return json_decode($response);
			}
		}
	}
}


class AVLibraryException extends \Exception{
	public function __construct($message, $code = 0, Exception $previous = null) {
		//codes are only set by a AVOSCloud.com error
		if($code != 0){
			$message = "AVOSCloud.com error: ".$message;
		}

		parent::__construct($message, $code, $previous);
	}

	public function __toString() {
		return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
	}

}

?>
