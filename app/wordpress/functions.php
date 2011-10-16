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
  $config = $_framework_config[$configName];
  return is_null($config) ? array() : $config;
}
function _get_wp_config($key) {
  $_config = _framework_get_config('wp');
  return is_null($key) ? $_config : $_config[$key];
}
function _get_adjacent_post_text($real_text, $empty_title, $previous = true, $in_same_cat = false, $excluded_categories = '') {
  if ($previous && is_attachment())
    $post = &get_post($GLOBALS['post']->post_parent);
  else
    $post = get_adjacent_post($in_same_cat, $excluded_categories, $previous);

  if (!$post)
    return $real_text;

  $title = $post->post_title;
  if (empty($title))
    $real_text = str_replace('%title', $empty_title, $real_text);

  return $real_text;
}
function alamix_previous_post_link($format='&laquo; %link', $link='%title', $empty_title = '', $in_same_cat = false, $excluded_categories = '') {
  $link = _get_adjacent_post_text($link, $empty_title, true, $in_same_cat, $excluded_categories);
  previous_post_link($format, $link, $in_same_cat, $excluded_categories);
}
function alamix_next_post_link($format='&laquo; %link', $link='%title', $empty_title = '', $in_same_cat = false, $excluded_categories = '') {
  $link = _get_adjacent_post_text($link, $empty_title, false, $in_same_cat, $excluded_categories);
  next_post_link($format, $link, $in_same_cat, $excluded_categories);
}
?>