<?php

require_once 'SOAP/Server.php';

$skiptrace =& PEAR::getStaticProperty('PEAR_ERROR', 'skiptrace');

$skiptrace = true;

//The Service class

class SomeService {
	public function watIsTime(){
		date_default_timezone_set('Asia/Calcutta');

		return (date("H:i"));

	}
}


$service = new SomeService();

//SOAP Server

$ss = new SOAP_SERVER();

//assigning a name to the service
$ss->addObjectMap(&$service, "urn:SomeService");

//POST Data to the service

if(isset($_SERVER['QUERY_STRING']) && strcasecmp($_SERVER['QUERY_STRING'], 'wsdl')==0){

	require_once "SOAP/Disco.php";

	$disco = new SOAP_DISCO_Server ($ss, "SomeService", "It is SomeService");

	header("Content-type: text/xml");

	echo $disco->getWSDL();
}

else{
	
	$ss->service($HTTP_RAW_POST_DATA);


}


?>