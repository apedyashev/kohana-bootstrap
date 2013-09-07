<?php
/**
 * This helper is designed to export PHP variables int JS varibles
 */
class Helper_Js {
  private static $_vars = array();

  /**
   * Adds variable. 
   * 
   * Limitation:  In case if $inVarName is chain of nested object, then you 
   * should take care about exisinse of all nestsed objects in the chain
   * 
   * @param type $inVarName
   * @param type $inVarVal  = array of discrete value
   */
  public static function addVar( $inVarName, $inVarVal ){
    if(is_string($inVarVal) ){
      self::$_vars[$inVarName] = '"' . $inVarVal . '"';
    }
    elseif(is_array( $inVarVal )) {
      self::$_vars[$inVarName] = json_encode($inVarVal);
    }
    else{
      self::$_vars[$inVarName] = $inVarVal;
    }
  }
  
  /**
   * Renders PHP variables added by addVar function into JS variables
   */
  public static function render(){
    echo '<script type="text/javascript">';
    foreach( self::$_vars as $varName => $varVal ){
      if(is_array($varVal)){
        echo "{$varName} = " . json_encode($varVal) . ";";
      }
      else{
        echo "{$varName} = $varVal;";
      }
    }
    echo '</script>';
  }
}
?>
