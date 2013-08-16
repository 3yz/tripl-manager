<?php defined('SYSPATH') OR die('No direct script access.');

class Form extends Kohana_Form {

  /**
   * Creates a select form input from a model.
   *
   *     echo Form::select('country', $countries, $country);
   *
   * [!!] Support for multiple selected options was added in v3.0.7.
   *
   * @param   string  $name       input name
   * @param   array   $options    available options
   * @param   mixed   $selected   selected option string, or an array of selected options
   * @param   array   $attributes html attributes
   * @return  string
   * @uses    HTML::attributes
   */
  public static function select_from_model($name, $model, array $config = NULL, $selected = NULL, array $attributes = NULL)
  {
    $options = array();

    $base_config = array(
      'empty' => false,
      'value' => 'id',
      'text'  => 'name'
    );

    $config = array_merge(
      $base_config,
      $config
    );

    if($config['empty']){
      $options[''] = $config['empty'];
    }

    $registers = ORM::factory($model)->find_all();

    foreach ($registers as $obj) {
      $options[$obj->$config['value']] = $obj->$config['text'];
    }

    return parent::select($name, $options, $selected, $attributes);
  }

}
