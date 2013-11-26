<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Profile managment controller
 * 
 * Extends My_LoggedUsersController so you can be sure that only LOGGED users  have access to actions of this controller
 * 
 */
class Controller_Profile extends My_LoggedUsersController {

  public function action_index(){
    // You can be sure that $this->_loggedUser contains logged user. No additional checkings required
  }
} 
