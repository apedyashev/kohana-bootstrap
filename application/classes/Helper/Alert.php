<?php
/**
 * Gets/Sets alerts messages and CSS classes to render in view
 */
class Helper_Alert {
  
  /**
   * Sets CSS class and message for alert
   * 
   * @param type $inClass
   * @param type $inMessage
   */
  public static function setAlert( $inClass, $inMessage ){
    Helper_Output::setFlashData('alertClass', $inClass);
    Helper_Output::setFlashData('alertMessage', $inMessage);
  }
  
  /**
   * Returns alert data object with following fields:
   *  - class
   *  - message
   * 
   * @return \stdClass
   */
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
