<?php

class Helper_HeadImport {

  private static $m_JsArray   = array();
  private static $m_CssArray  = array();
  private static $m_AnyData   = array();
  
  public static function linkJsFlexPath( $inJsFile ){
    $jsFullName = URL::site( "$inJsFile.js" );  
    
    array_push( self::$m_JsArray, $jsFullName);
  }
  
  public static function linkJs( $inJsFile ){
    $jsFullName = URL::site( "/assets/js/$inJsFile.js" );  
    
    array_push( self::$m_JsArray, $jsFullName);
  }
  
  public static function linkExternalJs( $inJsFile ){
    array_push( self::$m_JsArray, $inJsFile);
  }
  
  public static function linkCss( $inCssFile ){
    $cssFullName = URL::site( "/assets/css/$inCssFile.css" );  
    
    array_push( self::$m_CssArray, $cssFullName);
  }

  public static function linkCssFlexPath( $inCssFile ){
    $cssFullName = URL::site( "$inCssFile.css" );  
    
    array_push( self::$m_CssArray, $cssFullName);
  }
  
  public static function linkCssFromAnyPath( $inCssFile ){
    $cssFullName = URL::site( "$inCssFile.css" );  
    
    array_push( self::$m_CssArray, $cssFullName);
  }
  
  public static function linkExternalCss( $inCssFile ){
    array_push( self::$m_CssArray, $inCssFile);
  }
  //-----------------------------------------------------------------------------------------------------------------------------

  public static function addAnyData( $inData  ){
    array_push( self::$m_AnyData, $inData);
  }
  //-----------------------------------------------------------------------------------------------------------------------------
  
  public static function renderAll(){
    
    //css
    foreach( self::$m_CssArray as $css ){
      echo '<link rel="stylesheet" type="text/css" href="' . $css . '"/>' . "\n";
    }
    
    //js
    foreach( self::$m_JsArray as $js ){
      echo '<script type="text/javascript" src="' . $js . '"></script>' . "\n";
    }
    
    //data
    foreach( self::$m_AnyData as $data ){
      echo $data . "\n";
    }
    
  }
  //-----------------------------------------------------------------------------------------------------------------------------
  
}
?>
