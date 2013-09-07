<?php

class Helper_Output{

  public static function print_r( $inWhat ){
    echo "<pre>";
    print_r( $inWhat );
    echo "</pre>";
  }
  
  public static function var_dump( $inWhat ){
    echo "<pre>";
    var_dump( $inWhat );
    echo "</pre>";
  }
  
  public static function getCurrentLanguageAlias(){
      return I18n::$lang;
  }
  
  public static function setFlashData( $inDataId, $inData ){
      Session::instance()->set( $inDataId, $inData );
  }

  public static function getFlashData( $inDataId ){
      return Session::instance()->get_once( $inDataId, false );
  }

}

?>
