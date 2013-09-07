<?php
/**
 * 
 * Helper to manage assets from controllers and renders them in the layout/view
 * 
 */
class Helper_HeadImport {

  private static $m_JsArray   = array();
  private static $m_CssArray  = array();
  private static $m_AnyData   = array();
  
  /**
   * Add JS file from any location in the project to the list of JS files to be rendered
   * 
   * Difference from linkJs - linkJs is binded to the assets/js folder but this function is not
   * 
   * Example: Helper_HeadImport::linkJs('somefolder/bootsrap/bootstrap.min') - will add somefolder/bootsrap/bootstrap.min.js
   * 
   * @param type $inJsFile
   */
  public static function linkJsFlexPath( $inJsFile ){
    $jsFullName = URL::site( "$inJsFile.js" );  
    
    array_push( self::$m_JsArray, $jsFullName);
  }
  
  /**
   * Add JS file from assets/js folder to the list of JS files to be rendered
   * 
   * Example: Helper_HeadImport::linkJs('my-js-file') - will add assets/js/my-js-file.js
   * 
   * @param type $inJsFile
   */
  public static function linkJs( $inJsFile ){
    $jsFullName = URL::site( "/assets/js/$inJsFile.js" );  
    
    array_push( self::$m_JsArray, $jsFullName);
  }
  
  /**
   * Add JS file from external location to the list of JS files to be rendered
   * 
   * Example: Helper_HeadImport::linkJs('http://some-cdn-server.com/some-js-file.js') - will add http://some-cdn-server.com/some-js-file.js
   * 
   * @param type $inJsFile
   */
  public static function linkExternalJs( $inJsFile ){
    array_push( self::$m_JsArray, $inJsFile);
  }
  
  /**
   * Add CSS file from assets/css folder to the list of CSS files to be rendered
   * 
   * Example: Helper_HeadImport::linkCss('my-css-file') - will add assets/css/my-css-file.css
   * 
   * @param type $inCssFile
   */
  public static function linkCss( $inCssFile ){
    $cssFullName = URL::site( "/assets/css/$inCssFile.css" );  
    
    array_push( self::$m_CssArray, $cssFullName);
  }

  /**
   * Add CSS file from any location in the project to the list of CSS files to be rendered
   * 
   * Difference from linkCss - linkJs is binded to the assets/css folder but this function is not
   * 
   * Example: Helper_HeadImport::linkJs('somefolder/bootsrap/bootstrap.min') - will add somefolder/bootsrap/bootstrap.min.css
   * 
   * @param type $inJsFile
   */
  public static function linkCssFlexPath( $inCssFile ){
    $cssFullName = URL::site( "$inCssFile.css" );  
    
    array_push( self::$m_CssArray, $cssFullName);
  }
  
  
  /**
   * Add CSS file from external location to the list of CSS files to be rendered
   * 
   * Example: Helper_HeadImport::linkJs('http://some-cdn-server.com/my-css-file.css') - will add http://some-cdn-server.com/my-css-file.css
   * 
   * @param type $inCssFile
   */
  public static function linkExternalCss( $inCssFile ){
    array_push( self::$m_CssArray, $inCssFile);
  }
  //-----------------------------------------------------------------------------------------------------------------------------

  /**
   * Adds any string that could be rendered in the HEAD of HTML (for example meta tags)
   * @param type $inData
   */
  public static function addAnyData( $inData  ){
    array_push( self::$m_AnyData, $inData);
  }
  //-----------------------------------------------------------------------------------------------------------------------------
  
  /**
   * Renders all previously added data
   */
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
