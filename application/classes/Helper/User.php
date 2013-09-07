<?php
/**
 * Helper for common actions with user
 */
class Helper_User{

  /**
   * Returns fullname of given user
   * 
   * @param type $inUser
   * @return type
   */
  public static function getFullName( $inUser ){
    return $inUser->data->firstname . " " . $inUser->data->lastname;
  }

}

?>
