<?php defined('SYSPATH') or die('No direct script access.');

class Task_Admin_Users extends Minion_Task {

  protected $_options = array(
    'method'   => NULL,
    'name'     => NULL,
    'username' => NULL,
    'email'    => NULL,
    'password' => NULL,
    'role'     => 'manager'
  );

  protected function _execute(array $options)
  {
    if(!method_exists($this, $options['method'])){
      return Minion_CLI::write('Método inválido!');
    }
    $this->$options['method']($options);

  }

  protected function add(array $options)
  {
    if($options['username'] == ''){
      return Minion_CLI::write('Informe um username (--username)!');
    }
    if($options['email'] == ''){
      return Minion_CLI::write('Informe um e-mail (--email)!');
    }
    if($options['password'] == ''){
      return Minion_CLI::write('Informe um password (--password)!');
    }

    $roles = array();
    $roles[] = ORM::factory('Role')->where('name', '=', 'login')->find();

    $role = ORM::factory('Role')->where('name', '=', $options['role'])->find();
    if(!$role->loaded()) {
      return Minion_CLI::write('Role inválida!'); 
    }
    $roles[] = $role;

    try {
      $user = ORM::factory('User');
      $user->create_user(
        array_merge(
          $options, 
          array(
            'password_confirm' => $options['password']
          )
        ), 
        array('name', 'email', 'username', 'password')
      );
      foreach($roles as $role){
        $user->add('roles',$role);
      }
    } catch (ORM_Validation_Exception $e) {
        $errors = $e->errors();
    }
    
    if(!isset($errors)) {
      return Minion_CLI::write('Usuário criado!'); 
    } else {
      //TODO - show a nice error message
      var_dump($errors);
    }
    

  }

  protected function delete(array $options)
  {
    //TODO implement
  }

} // End Pages