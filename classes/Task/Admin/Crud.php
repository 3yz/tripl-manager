<?php defined('SYSPATH') or die('No direct script access.');

class Task_Admin_Crud extends Minion_Task {

  protected $model = NULL,
            $model_singular = NULL,
            $model_plural = NULL,
            $model_u_singular = NULL,
            $model_u_plural = NULL,
            $singular = NULL,
            $plural = NULL,
            $view_path = NULL,
            $controller_path = NULL;

  protected $_options = array(
    'singular' => NULL,
    'plural'   => NULL,
    'model'    => NULL,
  );

  public function build_validation(Validation $validation)
  {
    return parent::build_validation($validation)
      ->rule('singular', 'not_empty')
      ->rule('plural', 'not_empty')
      ->rule('model', 'not_empty');
  }

  protected function _execute(array $options)
  {
    $this->model = $options['model'];
    $this->model_singular = strtolower($options['model']);
    $this->model_plural = strtolower(Inflector::plural($options['model']));
    $this->model_u_singular = $options['model'];
    $this->model_u_plural = Inflector::plural($options['model']);
    $this->singular = $options['singular'];
    $this->plural = $options['plural'];
    $this->view_path = APPPATH . 'views/';
    $this->controller_path = APPPATH . 'classes/Controller/';

    $this->create_dirs($options);    

    $this->copy_files($options);

    $this->build_form($options);

    // if(!method_exists($this, $options['method'])){
    //   return Minion_CLI::write('Método inválido!');
    // }
    // $this->$options['method']($options);

  }

  protected function create_dirs($options) 
  {
    Minion_CLI::write('Creating directory structure.');
    if(!file_exists($this->controller_path . 'Manager')) {
      Minion_CLI::write('- '.$this->controller_path.'Manager');
      mkdir($this->controller_path . 'Manager');
    }
    if(!file_exists($this->view_path.'manager')) {
      Minion_CLI::write('- '.$this->view_path.'manager');
      mkdir($this->view_path.'manager');
    }
    if(!file_exists($this->view_path.'manager/' . $this->model_plural)) {
      Minion_CLI::write('- '.$this->view_path.'manager/' . $this->model_plural);
      mkdir($this->view_path.'manager/' . $this->model_plural);
    }
  }

  protected function copy_files($options) 
  {
    Minion_CLI::write('Copying controllers.');
    $path = MODPATH . 'tripl-manager/skeleton/controllers';
    $iterator = new DirectoryIterator($path);
    foreach ( $iterator as $entry ) {
      if($entry->isFile()) {
        Minion_CLI::write('- '.$this->controller_path.'Manager/'.$this->model_u_plural.'.php');
        copy($entry->getPathname(), $this->controller_path.'Manager/'.$this->model_u_plural.'.php');
        $this->replace_content($this->controller_path.'Manager/'.$this->model_u_plural.'.php', $options);
      }
    }
    Minion_CLI::write('Copying views.');
    $path = MODPATH . 'tripl-manager/skeleton/views';
    $iterator = new DirectoryIterator($path);
    foreach ( $iterator as $entry ) {
      if($entry->isFile()) {
        Minion_CLI::write('- '.$this->view_path.'manager/'.$this->model_plural.'/'.$entry);
        copy($entry->getPathname(), $this->view_path.'manager/'.$this->model_plural.'/'.$entry);
        $this->replace_content($this->view_path.'manager/'.$this->model_plural.'/'.$entry, $options);
      }
    }
  }

  protected function build_form($options)
  {
    $form = file_get_contents($this->view_path.'manager/'.$this->model_plural.'/_form.php');

    $new_content = '';

    $container = '
  <div class="control-group <?php echo Arr::get($errors, \'{field_name}\') ? \'error\' : \'\' ?>">
    <label class="control-label" for="{model_singular}_{field_name}">{label}</label>
    <div class="controls">
      {field}
      {message}
    </div>
  </div>
';

    $model = ORM::factory($options['model']);
    $columns = $model->table_columns();
    $labels = $model->labels();
    $belongs_to = $model->belongs_to();
    foreach($columns as $field => $column_options){
      if($field != 'id') {
        $label = (array_key_exists($field, $labels)) ? $labels[$field] : ucfirst($field);
        $content = str_replace('{field_name}', $field, $container);
        $content = str_replace('{model_singular}', $this->model_singular, $content);
        $content = str_replace('{label}', $label, $content);
        $content = str_replace('{message}', $this->build_message($field, $column_options), $content);
        $content = str_replace('{field}', $this->build_field($field, $column_options, $belongs_to), $content);

        $new_content.= $content;
      }
    }

    $form = str_replace('{fields}', $new_content, $form);
    file_put_contents($this->view_path.'manager/'.$this->model_plural.'/_form.php', $form);

  }

  private function build_message($field, $column_options)
  {
    $message = '<small class="help-block">%s</small>';
    $phrase = array();
    if(!$column_options['is_nullable']) {
      $phrase[] = 'Campo obrigatório';
    }

    return sprintf(
      $message,
      implode('. ', $phrase)
    );
  }

  private function build_field($field, $column_options, $belongs_to)
  {
    $id = $this->model_singular.'_'.$field;
    $class = array('input-xxlarge');    
    $type = NULL;

    switch($column_options['data_type']){
    case 'text':
    case 'mediumtext':
    case 'longtext':
      $field_html = '<?php echo Form::textarea(\'%s\', $obj->%s, %s); ?>';

      break;
    case 'int':
      if(substr($field, -3) == '_id') {
        $related_model = $belongs_to[substr($field, 0, -3)]['model'];
        $class = array('input-large');
        $field_html = '<?php echo Form::select_from_model(\'%s\', \''.$related_model.'\', array(\'empty\' => \'selecione\', \'text\' => \'id\'), $obj->%s, %s); ?>';
      } else {
        $type = 'number';
        $class = array('input-medium');
        $field_html = '<?php echo Form::input(\'%s\', $obj->%s, %s); ?>';
      }

      break;
    case 'date' : 
      $class[] = 'datepicker';
      $field_html = '<?php echo Form::input(\'%s\', $obj->%s, %s); ?>';

      break;
    case 'datetime' : 
      $class[] = 'datetimepicker';
      $field_html = '<?php echo Form::input(\'%s\', $obj->%s, %s); ?>';

      break;
    default:     
      $field_html = '<?php echo Form::input(\'%s\', $obj->%s, %s); ?>';
    }

    $options = array('id' => $id, 'class' => $class);
    if(!is_null($type)) {
      $options['type'] = $type;
    }

    $opt = 'array(';
    foreach($options as $key => $value) {
      $value = (is_array($value)) ? implode(' ', $value) : $value;
      $opt.= "'$key' => '$value',";
    }
    $opt.=')';

    return sprintf(
      $field_html,
      $field,
      $field,
      $opt      
    );

  }

  private function replace_content($path, $options)
  {
    $replaces = array(
      'model',
      'model_plural',
      'model_singular',
      'model_u_plural',
      'model_u_singular',
      'plural',
      'singular'
    );
    $file = file_get_contents($path);
    foreach($replaces as $key) {
      $file = str_replace('{'.$key.'}', $this->$key, $file);
    }
    file_put_contents($path, $file);
  }

  // protected function generate(array $options)
  // {
  //   $sql = file_get_contents(DOCROOT. 'modules/tripl-manager/auth-schema-mysql.sql');
  //   $queries = explode("\n\n", $sql);

  //   try {
  //     foreach($queries as $query) {
  //       $result = DB::query(NULL, $query)->execute();  
  //     }  
  //     return Minion_CLI::write('Tabelas de administração criadas com sucesso!'); 
  //   } catch(\Exception $e) {
  //     return Minion_CLI::write('Erro! Houve um problema ao gerar as tabelas'); 
  //   }

  // }

}