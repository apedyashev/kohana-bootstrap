<?php
/**
 * This helper is designed to export PHP variables int JS varibles
 */
class Helper_Alert {
  
  public static function setAlert( $inClass, $inMessage ){
    Helper_Output::setFlashData('alertClass', $inClass);
    Helper_Output::setFlashData('alertMessage', $inMessage);
  }
  
  public static function getAlert(){
    $inClass    = Helper_Output::getFlashData('alertClass');
    $inMessage  = Helper_Output::getFlashData('alertMessage');
    $alert = new stdClass();
    $alert->class   = $inClass;
    $alert->message = $inMessage;
    
    return $alert;
  }
  
}
?>
