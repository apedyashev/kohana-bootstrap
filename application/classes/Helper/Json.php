<?php

class Helper_Json {

  private static $_isSuccess = true;
  private static $_messages  = array();
  private static $_data      = array();

  /**
   * @name setSuccess
   * @description sets some operation's result 
   * 
   * @param bool $inIsSuccess - success or not
   */
  public static function setSuccess( $inIsSuccess ){
    self::$_isSuccess = $inIsSuccess;
  }
  
  
  /**
   * @name setMessages
   * @description array set contains messages 
   * 
   * @param Array $inMessagesArray
   */
  public static function setMessages( $inMessagesArray ){
    self::$_messages = $inMessagesArray;
  }
  
  
  /**
   * @name addMessage
   * @description adds new message
   * 
   * @param string $inMessageKey
   * @param string $inMessageValue
   */
  public static function addMessage( $inMessageKey, $inMessageValue ){
    self::$_messages[ $inMessageKey ] = $inMessageValue;
  }
  

  /**
   * @name setData
   * @description sets data array
   * 
   * @param Array $inData
   */
  public static function setData( $inData ){
    self::$_data = $inData;
  }

  
  /**
   * @name addData
   * @description adds data element
   * 
   * @param string $inMessageKey
   * @param string $inMessageValue
   */
  public static function addData( $inMessageKey, $inMessageValue ){
    self::$_data[ $inMessageKey ] = $inMessageValue;
  }
  
  
  /**
   * @name renderAndDie
   * @description prints JSON and exits to prevent further output
   * 
   * @param string $inJsonPCallback if you use JSONP then set this param to JSONP callback
   */
  public static function renderAndDie( $inJsonPCallback = false ){
    $arrayForJson = array(
        'success' => self::$_isSuccess,
        'messages' => self::$_messages,
        'data' => self::$_data
         
    );
    
    header('Content-type: application/json'); 
    
    if( $inJsonPCallback ){
      die( $inJsonPCallback . "(" . json_encode( $arrayForJson ) . ")" );
    }
    else{
      die( json_encode( $arrayForJson ) );
    }
    
  }
  
}
?>
