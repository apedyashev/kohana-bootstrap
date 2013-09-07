<?php defined('SYSPATH') or die('No direct script access.');

class My_AdminController extends My_Layout {
  protected $_viewData;
  protected $_loggedUser;
  
  public function before(){
    parent::before();
    
    //prevent access of non-authenticated members
    if( Helper_Auth::isAdminPanelAllowed() ){
      $this->_viewData = new stdClass();
      
      $currentPage = $this->request->action();
//      var_dump($currentPage); die;
      $header = View::factory('partials/admin/header')->set('currentPage', $currentPage)->render();
      $this->setHeader($header);
      Helper_HeadImport::linkCssFlexPath('assets/foundation/css/foundation.min');
    }
    else{
      //user is not authenticated - redirect to login page
      if( $this->request->is_ajax() ){
        Helper_Json::setSuccess(false);
        Helper_Json::addData('status', 'not_auth');
        Helper_Json::renderAndDie();
      }
      else {
        $this->redirect( URL::site('admin/session/login') );
      }
      exit();
    }
  }
  
  
} 

?>
