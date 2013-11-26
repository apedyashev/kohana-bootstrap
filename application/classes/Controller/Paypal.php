<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class that implements paypal payment processing
 */
class Controller_Paypal extends My_AnyUsersController {
  const PAYPAL_STATUS_COMPLETED = 'Completed';
  
  /**
   * Action that renders page where user is redirected to after  payment is done
   */
  public function action_done(){
    $transactionId = $this->request->query('tx');
    $status        = $this->request->query('st');
    $amount        = $this->request->query('amt');
    $currency      = $this->request->query('cc');
    $itemNumber    = $this->request->query('item_number');
    
    $expectedAmount   = Kohana::$config->load('config')->get('job.posting.price');
    $expectedCurrency = Kohana::$config->load('config')->get('job.posting.currency');
    $jobId = 0;
    
    $isPaymentValid = ($status == self::PAYPAL_STATUS_COMPLETED) && 
            ($amount == $expectedAmount) &&
            ($currency == $expectedCurrency);
    //check if GET params are valid
    if($isPaymentValid){
      $transaction = ORM::factory('Transaction')->where('transaction_id', '=', $transactionId)->find();
      //check if transaction found in the Transactions table
      if($transaction->id){
        //check if transaction has been verified
        if( $transaction->is_verified == true ){
          $errorCode = 'ok';
          $job = ORM::factory('Job', $transaction->item_number);
          //if job found then mark it as paid
          if($job->id){
            if( !$job->is_paid ){
              $job->is_paid = true;
              $job->save();
            }
          }
          else{
            $jobId = $job->id;
            $errorCode = 'job_not_found';
          }
        }
        else{
          $errorCode = 'tr_not_verified';
          Helper_Js::addVar('SYS.transactionId', $transactionId);
          Helper_HeadImport::linkJs('verify-transaction');
        }
      }
      else{
        $errorCode = 'trn_not_found';
        Helper_Js::addVar('SYS.transactionId', $transactionId);
        Helper_HeadImport::linkJs('verify-transaction');
      }
    }
    else{
      $errorCode = 'invalid_trn_details';
    }
    
    $content = View::factory('payment/done')
            ->set('errorCode', $errorCode)
            ->set('details', $this->request->query())
            ->set('jobId', $jobId)
            ->set('transactionId', $transactionId)
            ->render();
    
    echo $this->
      setTitle( __('Done') )->
      addData('headData', array('title' => "<span>Find</span> Designers'&nbsp;Jobs") )->
      setKeywords( '' )->
      setDescription( '' )->
      setContent( $content )->render();
  }
  
  /**
   * This action is used to check if transaction has been verified
   * It takes transactions ID and looks for this entry in DB. 
   * 
   * Returns JSON
   */
  public function action_ajax_verify_transaction(){
    $transactionId  = $this->request->query('id');
    $transaction    = ORM::factory('Transaction')->where('transaction_id', '=', $transactionId)->find();
    
    if( $transaction->id ){
      //transaction found, check if it is verified
      
      Helper_Json::addData('isVerified', (bool)$transaction->is_verified );
      if($transaction->is_verified){
        Helper_Json::setSuccess( true );
        $html = View::factory('payment/partials/transaction_ok')->render();
      }
      else{
        //transaction found but not verified
        Helper_Json::setSuccess( false );
        $html = View::factory('payment/partials/transaction_not_verified')->set('transactionId', $transactionId)->render();
      }
    }
    else{
      //transaction not found
      Helper_Json::setSuccess( false );
      $html = View::factory('payment/partials/transaction_not_found')->set('transactionId', $transactionId)->render();
    }
    
    Helper_Json::addData('html', $html );
    Helper_Json::renderAndDie();
  }

  /**
   * Callback function that is  invoked by paypal
   */
  public function action_status_cb(){
      $ipnListener = Library_Paypal_IpnListener::factory();
      $ipnListener->use_sandbox = Kohana::$config->load('config')->get('paypal.use_sandbox');
      
      $transaction = ORM::factory('Transaction');
      
      // try to process the IPN POST
      try {
          $ipnListener->requirePostMethod();
          $verified     = $ipnListener->processIpn();
          $isException  = false;
      } catch (Exception $e) {
          $verified     = false;
          $isException  = true;
          $transaction->payment_status  = 'verify_exception';
          $transaction->errors          = $e->getMessage();
      }
      
      if(!$isException){
        $transaction->payment_status  = $this->request->post('payment_status');
      }
      $transaction->is_verified     = $verified;
      $transaction->data            = json_encode( $this->request->post() );
      $transaction->transaction_id  = $this->request->post('txn_id');
      $transaction->payer_email     = $this->request->post('payer_email');
      $transaction->item_number     = $this->request->post('item_number');
      $transaction->save();
      
      $job = ORM::factory('Job', $transaction->item_number);
      //if job found then mark it as paid
      if($job->id){
        $job->is_paid = true;
        $job->save();

        //send out email notification to admin
        $adminRole = ORM::factory('Role', array('name'=> 'admin') );
        $adminEmails = array();
        if($adminRole->id){
          foreach($adminRole->users->find_all() as $admin){
            $adminEmails[$admin->email] = Helper_User::getFullName( $admin );
          }
        }
        Mailer::factory('notifications')->send_new_job( array(
          'request'	=> array(
              'emails'    => $adminEmails,
              'job'       => $job
          )
        ));
        
      }
      else{
        $transaction->errors = "Job with ID {$transaction->item_number} not found";
        $transaction->save();
      }
          
  }
  
  
}
