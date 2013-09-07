<?php
/**
 * Auth helper
 */
class Helper_Auth{
  private static $_errors = array();
  

  /**
   * Login user using email and password
   * 
   * @param type $inUserName
   * @param type $inPass
   * @param type $inRemember
   * @return type
   */
  public static function login( $inUserName, $inPass, $inRemember = false ){
    return Auth::instance()->login($inUserName, $inPass, $inRemember);
  }
  
  /**
   * Creates user with admin role
   * 
   * @param array/hash $inUserData - array('username' => '', 'password' => '', 'email' => '', 'firstname' => '', 'lastname' => '')
   * @return boolean -  returns true if user has been created then
   * 
   * NOTE: if function returned FALSE  then errors can be obtained using getErrors() function of this class
   */
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
  
  
  /**
   * Checks is there are logegd in user in the session
   * 
   * @return type
   */
  public static function isLoggedIn(){
    return self::getUser();
  }
  
  /**
   * Returns logged in user
   * 
   * @return type
   */
  public static function getUser(){
    return Auth::instance()->get_user();
  }
  
  /**
   * Checks if current user has admin role
   * 
   * @return boolean
   */
  public static function isAdmin(){
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
  
  /**
   * Returns errors set by createAdmin func
   * 
   * @return type
   */
  public static function getErrors(){
    return self::$_errors;
  }
  
  /**
   * Logs out user
   */
  public static function logout(){
    Auth::instance()->logout();
  }
  
}

?>
