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

  class MyWPController extends ApplicationController {
    public function header() { return _get_header(); }
  }
  MyWPRegistry::set('Controller', new MyWPController(array()));
  MyWPRegistry::get('Controller')->push('javascripts', 'menu.js');
  MyWPRegistry::set('Template', new ApplicationTemplate('', '', array()));
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

function _css($src, $global = false) {
  return MyWPRegistry::get('Template')->_css($src, $global);
}

function _get($key = null) {
  return MyWPRegistry::get('Controller')->get($key);
}

function _framework_get_config($configName) {
  global $_framework_config;
  if (empty($_framework_config)) {
    $_framework_config = array();
  }
  if (!array_key_exists($configName, $_framework_config)) {
    $_framework_config[$configName] = get_config($configName);
  }
  return $_framework_config[$configName];
}

?>