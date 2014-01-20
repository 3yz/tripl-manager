<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Manager_{model_u_plural} extends Controller_Manager_Application {
  
  public function before(){
    parent::before();

    $this->template->title .= ' - {plural}';
    if(!Auth::instance()->logged_in('admin') && $this->request->action() != 'profile'){
      $this->redirect('manager/dashboard');
    }
  }
  
  public function action_index()
  {
    $view = View::factory('manager/{model_plural}/index');
    $view->collection = ORM::factory('{model}')->find_all();

    $this->template->content = $view;

  }
  
  public function action_new()
  {
    $this->template->title .= ' - novo';

    $obj = ORM::factory('{model}');
    
    $view = View::factory('manager/{model_plural}/new');
    $view
      ->bind('obj', $obj)
      ->bind('errors', $errors);

    
    $this->template->content = $view;
  }
  
  public function action_create(){

    $obj = ORM::factory('{model}');
    
    $this->template->title .= ' - novo';
    $view = View::factory('manager/{model_plural}/new');    
      
    if($this->request->method() == Request::POST) {
      try {
        $obj->values($this->request->post())->save();

        Notices::add('success', '{singular} adicionado com sucesso');
        $this->redirect('manager/{model_plural}');
      } catch(ORM_Validation_Exception $e) {
        Notices::add('error', 'Confira os campos obrigatórios antes de continuar');
        $errors = $e->errors('models');
      }
    }

    $view
      ->bind('obj', $obj)
      ->bind('errors', $errors);

    $this->template->content = $view;
  }
  
  public function action_edit()
  {
    $obj = ORM::factory('{model}' ,$this->request->param('id'));
    
    $view = View::factory('manager/{model_plural}/edit');
    $view
      ->bind('obj', $obj)
      ->bind('errors', $errors);

    $this->template->content = $view;
  }
  
  public function action_update()
  {
    $obj = ORM::factory('{model}' ,$this->request->param('id'));

    $view = View::factory('manager/{model_plural}/edit');
    $view
      ->bind('obj', $obj)
      ->bind('errors', $errors);
    
    if($this->request->method() == Request::POST) {
      try {
        $obj->values($this->request->post())->save();

        Notices::add('success', '{singular} alterado com sucesso');
        $this->redirect('manager/{model_plural}');
      } catch(ORM_Validation_Exception $e) {
        Notices::add('error', 'Confira os campos obrigatórios antes de continuar');
        $errors = $e->errors('models');
      }
    }

    $this->template->content = $view;
  }
  
  public function action_delete()
  {
    $obj = ORM::factory('{model}', $this->request->param('id'));
    
    if($obj->delete()){
      Notices::add('info', 'Registro excluído com sucesso');
    }

    $this->redirect('manager/{model_plural}');
  }

} 
