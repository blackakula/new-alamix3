<?php
define('ROOT_DIR', realpath(dirname(__FILE__) . '/../../../..') . '/');

class MyWPRegistry {
  private static $data = array();

  public static function set($key, $value) { self::$data[$key] = $value; }
  public function &get($key = null) {
    if (is_null($key))
      return self::$data;
    return self::$data[$key];
  }
}

function loadConfig() {

  $setup = file_get_contents(ROOT_DIR.'config'.DIRECTORY_SEPARATOR.'setup.php');
  $setup = str_replace(array('function get_header()', '<?php', '?>'), array('function _get_header()', '', ''), $setup);
  eval($setup);
  
  foreach (sfYaml::load(ROOT_DIR . 'config/base.yml') as $key => $value) {
    $key = strtoupper($key);
    eval("define('{$key}', '{$value}');");
  }

  MyDispatcher::config();

  /* Load Routes and setting params */
  if (!get_routes()->is_readonly())
    require_once(get_config('CONFIG_DIR').'routes.php');

  MyWPRegistry::set('Template', new ApplicationTemplate('', '', array()));
  class MyWPController extends ApplicationController {
    public function header() { return _get_header(); }
  }
  MyWPRegistry::set('Controller', new MyWPController(array()));

}

function _include($file) {
  include(realpath(dirname(__FILE__)) . '/' . $file);
}

function _js($src, $global = false) {
  return MyWPRegistry::get('Template')->_js($src, $global);
}

function _img($src, $alt = null, $global = false, $attr = array()) {
  return MyWPRegistry::get('Template')->_img($src, $alt, $attr);
}

function _get($key = null) {
  return MyWPRegistry::get('Controller')->get($key);
}

?>