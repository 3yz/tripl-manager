<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Manager_Application extends Controller_Template {
  
  public $template = 'manager/templates/layout';
  public $view = null;
  public $title = 'Tripl';
  
  public function before(){
    parent::before();

    if (!(Auth::instance()->logged_in(array('manager')) || Auth::instance()->logged_in(array('admin'))) && ($this->request->controller() != 'sessions' && $this->request->action() != 'new')) {
      return $this->redirect('manager/login');
    }
    
    $this->template->title = $this->title;
  }
  
} // End Application
