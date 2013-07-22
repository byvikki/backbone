<?php

/**
 * SomeServiceService class
 * 
 * It is SomeService 
 * 
 * @author    {author}s
 * @copyright {copyright}
 * @package   {package}
 */
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

?>
