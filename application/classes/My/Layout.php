<?php defined('SYSPATH') or die('No direct script access.');

class My_Layout extends Controller {

  protected  $_directory;
  protected  $_controller;
  protected  $_action;
    
  protected $_template = "layout/main";
  
  protected $_siteName;
  protected $_data = array( 'keywords' => 'keywords', 'description' => 'description', 'content'=> false, 'title' => false,
    'header' => false, 'footer' => false );
  
  protected $_title;
 
  public function before() {
    parent::before();
    
    $this->_directory   = strtolower( $this->request->directory() );
    $this->_controller  = strtolower( $this->request->controller() );
    $this->_action      = strtolower( $this->request->action() );
    
    $sysObject = array( 'baseUrl' => URL::base(), 'dateFormatJs' =>  Kohana::$config->load('config')->get( 'date.format.js', 'yyyy.mm.d' ) );
    Helper_Js::addVar('SYS', $sysObject);
    
    Helper_HeadImport::linkCss('styles');
    Helper_HeadImport::linkJs( 'lib/jquery-1.8.3.min' );
    Helper_HeadImport::linkJs( 'lib/libs.min' );
    Helper_HeadImport::linkJs( 'lib/underscore-min' );
    Helper_HeadImport::linkJs( 'lib/spin.min' );
    Helper_HeadImport::linkJs( 'helpers' );
    Helper_HeadImport::linkJs( 'layout' );
    
    $this->_loggedUser = Helper_Auth::getUser();
    
    $this->_siteName = $config = Kohana::$config->load('config')->get( 'site.name', '' );
    
    $this->_configId = "{$this->_controller}.{$this->_action}";
    if( !empty($this->_directory) ){
      $this->_configId = "{$this->_directory}.$this->_configId";
    }
//    die( $this->_configId);
    
    $this->_data['description'] = Kohana::$config->load('config')->get( "seo.description.{$this->_configId}", '' );
    $this->_data['keywords']    = Kohana::$config->load('config')->get( "seo.keywords.{$this->_configId}", '' );
  }

  /**
   * 
   * @param type $inKeywordsString
   * @return \My_Layout
   */
  protected function setKeywords( $inKeywords ){
    if( !empty($inKeywords) ){
      if(is_array($inKeywords) ){
        foreach( $inKeywords as $keyword ){
          $this->_data['keywords'] .= ", {$keyword}";
        }
      }
      else{
        $this->_data['keywords'] .= ', '. $inKeywords;
      }
    }
    
    return $this;
  }
  
  /**
   * 
   * @return type
   */
  protected function getKeywords(){
    return $this->_data['keywords'];
  }
  
  /**
   * 
   * @param type $inDescription
   * @return \My_Layout
   */
  protected function setDescription( $inDescription, $inToOverride = false ){
    if( $inToOverride ){
      $this->_data['description'] = $inDescription;
    }
    else{
      if( !empty($inDescription) ){
        $this->_data['description'] .= ' ' . $inDescription;
      }
    }
    
    return $this;
  }
  
  /**
   * 
   * @return type
   */
  protected function getDescription(){
    return $this->_data['description'];
  }
  
  /**
   * 
   * @param type $inName
   * @return \My_Layout
   */
  protected function setSiteName( $inName ){
    $this->_siteName = $inName;
    
    return $this;
  }
  
  /**
   * 
   * @return type
   */
  protected function getSiteName(){
    return $this->_siteName;
  }
  
  /**
   * 
   * @param type $inTitle
   * @return \My_Layout
   */
  protected function setTitle( $inTitle ){
    $this->_title = $inTitle;
    
    return $this;
  }
  
  /**
   * 
   * @return type
   */
  protected function getTitle(){
    return $this->_title;
  }


  /**
   * 
   * @param type $inContent
   * @return \My_HtmlLayout
   */
  protected function setContent( $inContent ){
    $this->_data['content'] = $inContent;
    
    return $this;
  }
  
  /**
   * 
   * @param type $inHeader
   * @return \My_Layout
   */
  protected function setHeader( $inHeader ){
    $this->_data['header'] = $inHeader;
    
    return $this;
  }
     
  protected function setFooter( $inFooter ){
    $this->_data['footer'] = $inFooter;
    
    return $this;
  }
  
  /**
   * @name setTemplate
   * @abstract sets template file for this layout (default template is "view/layout/main")
   * 
   * @param type $inTemplateName
   * @return \My_HtmlLayout
   */
  protected function setTemplate( $inTemplateName ){
    $this->_template = $inTemplateName;
    
    return $this;
  }
  
  /**
   * 
   * @param type $inDataKey
   * @param type $inDataVal
   * @return \My_HtmlLayout
   */
  protected function addData( $inDataKey, $inDataVal ){
    $this->_data[$inDataKey ] = $inDataVal;
    
    return $this;
  }
  //-----------------------------------------------------------------------------------------------------------------------------

  /**
   * Renders page
   */
  protected function render(){
    $this->_data['title']        = $this->_title . " | " . $this->_siteName;
    return View::factory( $this->_template, $this->_data)->render();
  }
  
  
} 

?>
