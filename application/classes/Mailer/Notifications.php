<?php defined('SYSPATH') or die('No direct script access.');
class Mailer_Notifications extends Mailer{
	
  private $_domain;
  
  public function before(){
        $this->config = Kohana::$environment;
        
        $urlPieces            = parse_url( URL::base() );
        $this->_senderEmail   = 'noreply@' . $urlPieces[ 'host' ];
        $this->_siteName      = Kohana::$config->load( 'config' )->get('site.name');
  }
  //-----------------------------------------------------------------------------------------------------------------------------
  
  public function new_job($args){
    $this->type       = 'html';
    $this->to         = $args['request']['emails']; //array( $args['request']['email'] => $args['request']['email'] );
    $this->from       = array( $this->_senderEmail => __('Booking Calendar Notifier') );
    $this->subject    = $this->_siteName . ' ' . __('Job notifier');
    $args['job']      = $args['request']['job'];
//    $args['time']     = $args['request']['time'];
//    $args['subject']  = $args['request']['subject'];
//    $args['remainder']  = $args['request']['remainder'];
    $this->data       = $args;
  }
  
}