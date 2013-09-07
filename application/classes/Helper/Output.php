<?php
/**
 * Helper for output data to the browser
 * 
 */
class Helper_Output{

  /**
   * Wraps output of print_r with '<pre>' tag
   * 
   * @param type $inWhat
   */
  public static function print_r( $inWhat ){
    echo "<pre>";
    print_r( $inWhat );
    echo "</pre>";
  }
  
  /**
   * Wraps output of var_dump with '<pre>' tag
   * 
   * @param type $inWhat
   */
  public static function var_dump( $inWhat ){
    echo "<pre>";
    var_dump( $inWhat );
    echo "</pre>";
  }
  
  /**
   *  Retrurns current language that is used by I18n module
   * @return type
   */
  public static function getCurrentLanguageAlias(){
      return I18n::$lang;
  }
  
  /**
   * Sets flash data
   * 
   * @param type $inDataId
   * @param type $inData
   */
  public static function setFlashData( $inDataId, $inData ){
      Session::instance()->set( $inDataId, $inData );
  }

  /**
   * Gets flash data
   * 
   * @param type $inDataId
   * @return type
   */
  public static function getFlashData( $inDataId ){
      return Session::instance()->get_once( $inDataId, false );
  }

}

?>
