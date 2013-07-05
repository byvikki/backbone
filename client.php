<?php
//error_reporting(E_ALL);
ini_set('display_errors', '1');


class SomeServiceService extends SoapClient {

  private static $classmap = array(
                                   );

  public function SomeServiceService($wsdl = "http://localhost/myphp/server.php?wsdl", $options = array()) {
    foreach(self::$classmap as $key => $value) {
      if(!isset($options['classmap'][$key])) {
        $options['classmap'][$key] = $value;
      }
    }
    parent::__construct($wsdl, $options);
  }

}

require_once "SOAP/Client.php";


$sp_server_url = "http://localhost/myphp/server.php";

$sc = new SOAP_Client($sp_server_url);

$parameter = array();



$result = $sc->call("watIsTime", &$parameter, 'urn:SomeService');

echo $result."\n";


$wsdl = $sp_server_url . '?wsdl';

$client = new SomeServiceService();



echo 'done '. $client->watIsTime();

?>