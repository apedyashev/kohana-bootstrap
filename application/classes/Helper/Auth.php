<?php

class Helper_Auth{
  private static $_errors = array();
  

  public static function login( $inUserName, $inPass, $inRemember = false ){
    return Auth::instance()->login($inUserName, $inPass, $inRemember);
  }
  
  public static function createAdmin( $inUserData ){
    try{
      $user = ORM::factory('User')->create_user($inUserData, array(
        'username',
        'password',
        'email'				
      ));

      // Grant user login role
      $user->add('roles', ORM::factory('Role', array('name' => 'login')));
      $user->add('roles', ORM::factory('Role', array('name' => 'admin')));

      $userData = ORM::factory('User_Data');
      $userData->user_id    = $user->id;
      $userData->firstname  = $inUserData['firstname'];
      $userData->lastname   = $inUserData['lastname'];
      $userData->save();
      $isCreated = true;
    }
    catch(ORM_Validation_Exception $e){
      self::$_errors = $e->errors('models');
      $isCreated = false;
    }
    
    return $isCreated;
  }
  
  
  public static function isLoggedIn(){
    return self::getUser();
  }
  
  public static function getUser(){
    return Auth::instance()->get_user();
  }
  
  public static function isAdminPanelAllowed(){
    $user = Auth::instance()->get_user();
    if( $user ){
      $role       = ORM::factory( 'Role', array('name' => 'admin') );
      $isAllowed  = $user->has('roles', $role);
    }
    else{
      $isAllowed  = false;
    }
    
    return $isAllowed;
  }
  
  public static function getErrors(){
    return self::$_errors;
  }
  
  public static function logout(){
    Auth::instance()->logout();
  }
  
}

?>
