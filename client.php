<?php

require_once "SOAP/Client.php";

$sp_server_url = "http://localhost/myphp/index.php";

$sc = new SOAP_Client($sp_server_url);

$parameter = array();

$result = $sc->call("watIsTime", &$parameter, 'urn:SomeService');

echo $result."\n";


?>