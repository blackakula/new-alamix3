<?php
  function loadSpecific() {
    MyWPRegistry::get('Template')->set('menu-replace', 0);
    MyWPRegistry::get('Controller')->set('stylesheets', array('news.css'));
  }
  function _get_config($key = null) {
    $_config = _framework_get_config('news');
    if (is_null($key)) {
      return $_config;
    }
    return array_key_exists($key, $_config) ? $_config[$key] : _get_wp_config($key);
  }
?>