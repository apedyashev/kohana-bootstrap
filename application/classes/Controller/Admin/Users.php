<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Users managment controller
 * 
 * Extends My_AdminController so you can be sure that only users which have admin preveleges, have access to actions
 * of this controller
 */
class Controller_Admin_Users extends My_AdminController {

  public function action_index(){
    // You can be sure that $this->_loggedUser has admin role
  }
} 
