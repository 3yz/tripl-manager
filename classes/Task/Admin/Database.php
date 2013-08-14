<?php defined('SYSPATH') or die('No direct script access.');

class Task_Admin_Database extends Minion_Task {

  protected $_options = array(
    'method'   => NULL,
  );

  protected function _execute(array $options)
  {
    if(!method_exists($this, $options['method'])){
      return Minion_CLI::write('Método inválido!');
    }
    $this->$options['method']($options);

  }

  protected function generate(array $options)
  {
    $sql = file_get_contents(DOCROOT. 'modules/tripl-manager/auth-schema-mysql.sql');
    $queries = explode("\n\n", $sql);

    try {
      foreach($queries as $query) {
        $result = DB::query(NULL, $query)->execute();  
      }  
      return Minion_CLI::write('Tabelas de administração criadas com sucesso!'); 
    } catch(\Exception $e) {
      return Minion_CLI::write('Erro! Houve um problema ao gerar as tabelas'); 
    }

  }

}