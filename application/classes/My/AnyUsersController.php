<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller to be extended for any user access - logged or not
 */
class My_AnyUsersController extends My_UsersController {

  protected $_loggedUser;
  
  public function before(){
    parent::before();
    Helper_HeadImport::linkCss('designers');
    
    //pass search query to the view to display it in the search box
    $this->_data['searchQuery'] = $this->request->query('query');
  }
  
  
} 

?>
