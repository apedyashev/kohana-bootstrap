<?php

class Helper_User{

  public static function getFullName( $inUser ){
    return $inUser->data->firstname . " " . $inUser->data->lastname;
  }

}

?>
