<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Manager_Users extends Controller_Manager_Application {
  
  public function before(){
    parent::before();

    $this->template->title .= ' - Usuários';
    if(!Auth::instance()->logged_in('admin') && $this->request->action() != 'profile'){
      $this->request->redirect('manager/dashboard');
    }
  }
  
  public function action_index()
  {
    $view = View::factory('manager/users/index');
    $view->users = ORM::factory('user')->find_all();

    $this->template->content = $view;

  }
  
  public function action_show()
  {
    $view = View::factory('manager/users/show');
    $view->user = ORM::factory('user', $this->request->param('id'));
    
    $this->template->content = $view;
  }
  
  public function action_new()
  {
    $this->template->title .= ' - novo';

    $user = ORM::factory('User');
    $_roles = ORM::factory('Role')->where('name', '<>','login')->find_all();
    $roles = array();
    foreach($_roles as $role){
      $roles[$role->name] = $role->description;
    }

    $view = View::factory('manager/users/new');
    $view
      ->bind('user', $user)
      ->bind('roles', $roles)
      ->bind('errors', $errors);

    
    $this->template->content = $view;
  }
  
  public function action_create(){

    $user = ORM::factory('User');

    $_roles = ORM::factory('Role')->where('name', '<>','login')->find_all();
    $roles = array();
    foreach($_roles as $role){
      $roles[$role->name] = $role->description;
    }

    $this->template->title .= ' - novo';
    $view = View::factory('manager/users/new');    
      
    if($this->request->method() == Request::POST) {
      try {
        $user->create_user($this->request->post(), array('name', 'username', 'email', 'password'));

        //default login role
        $login_role = ORM::factory('role',array('name' => 'login'));
        $user->add('roles', $login_role);

        $login_role = ORM::factory('role',array('name' => $this->request->post('role')));
        $user->add('roles', $login_role);

        Notices::add('success', 'Usuário adicionado com sucesso');
        $this->redirect('manager/users');
      } catch(ORM_Validation_Exception $e) {
        Notices::add('error', 'Confira os campos obrigatórios antes de continuar');
        $errors = $e->errors('models');
      }
    }

    $view
      ->bind('user', $user)
      ->bind('roles', $roles)
      ->bind('errors', $errors);

    $this->template->content = $view;
  }
  
  public function action_edit()
  {
    $user = ORM::factory('User' ,$this->request->param('id'));
    
    $_roles = ORM::factory('Role')->where('name', '<>','login')->find_all();
    $roles = array();
    foreach($_roles as $role){
      $roles[$role->name] = $role->description;
    }

    $view = View::factory('manager/users/edit');
    $view
      ->bind('user', $user)
      ->bind('roles', $roles)
      ->bind('errors', $errors);

    $this->template->title .= ' - '.$user->username;
    $this->template->content = $view;
  }
  
  public function action_update()
  {
    $user = ORM::factory('User' ,$this->request->param('id'));

    $_roles = ORM::factory('Role')->where('name', '<>','login')->find_all();
    $roles = array();
    foreach($_roles as $role){
      $roles[$role->name] = $role->description;
    }

    $view = View::factory('manager/users/edit');
    $view
      ->bind('user', $user)
      ->bind('roles', $roles)
      ->bind('errors', $errors);
    
    if($this->request->method() == Request::POST) {
      try {
        $user->update_user($this->request->post(), array('name', 'username', 'email', 'password'));

        DB::delete('roles_users')
          ->where('user_id', '=', $user->id)
          ->where('role_id', '<>', '1')
          ->execute();
        
        $login_role = ORM::factory('role',array('name' => $this->request->post('role')));
        $user->add('roles', $login_role);

        Notices::add('success', 'Usuário alterado com sucesso');
        $this->redirect('manager/users');
      } catch(ORM_Validation_Exception $e) {
        Notices::add('error', 'Confira os campos obrigatórios antes de continuar');
        $errors = $e->errors('models');
      }
    }

    
    $this->template->title .= ' - '.$user->username;
    $this->template->content = $view;
  }

  public function action_profile(){
    $user = ORM::factory('User', Auth::instance()->get_user()->id);
    
    $_roles = ORM::factory('Role')->where('name', '<>','login')->find_all();
    $roles = array();
    foreach($_roles as $role){
      $roles[$role->name] = $role->description;
    }

    if($this->request->method() == Request::POST) {
      try {
        $user->update_user($this->request->post(), array('name', 'username', 'email', 'password'));

        DB::delete('roles_users')
          ->where('user_id', '=', $user->id)
          ->where('role_id', '<>', '1')
          ->execute();
        
        $login_role = ORM::factory('role',array('name' => $this->request->post('role')));
        $user->add('roles', $login_role);

        Notices::add('success', 'Perfil alterado com sucesso');
        $this->redirect('manager/users/profile');
      } catch(ORM_Validation_Exception $e) {
        Notices::add('error', 'Confira os campos obrigatórios antes de continuar');
        $errors = $e->errors('models');
      }
    }

    $view = View::factory('manager/users/profile');
    $view
      ->bind('user', $user)
      ->bind('roles', $roles)
      ->bind('errors', $errors);

    $this->template->title .= ' - '.$user->username;
    $this->template->content = $view;
  }
  
  public function action_delete()
  {
    $user = ORM::factory('User', $this->request->param('id'));
    DB::delete('roles_users')
          ->where('user_id', '=', $user->id)
          ->execute();
    
    if($user->delete()){
      Notices::add('info', 'Registro excluído com sucesso');
    }

    $this->redirect('manager/users');
  }

} // End Manager users
