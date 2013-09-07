<?php

class Helper_Input{

  public static function xssClean($str){
    return Security::xss_clean($str);
  }

}

?>
