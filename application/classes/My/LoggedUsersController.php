<?php defined('SYSPATH') or die('No direct script access.');

class My_LoggedUsersController extends My_UsersController {

  protected $_loggedUser;
  
//  public function __construct() {
  public function before()
  {
    parent::before();
    
    //prevent access of non-authenticated members
    if( $this->_loggedUser && $this->_loggedUser->id ){
      $this->_loggedUser->last_activity = gmdate('Y-m-d H:i:s', time());
      $this->_loggedUser->save();
      //do initialization here
      Helper_HeadImport::linkJs( 'lib/underscore-min' );
      Helper_HeadImport::linkJs( 'config' );
    }
    else{
      //user is not authenticated - redirect to error page
//      $message = "You don't have access to this page";
//      $content = View::factory('error')->set('message', $message)->render();
      
      $content = View::factory('session/login')->render();
    
      Helper_HeadImport::linkJs( 'login' );
    
      echo $this->
        setTitle( 'Access error' )->
        setContent( $content )->
        render();
      exit();
    }
  }
  
  
} 

?>
