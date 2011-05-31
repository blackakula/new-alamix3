<?php
  function loadSpecific() {
    MyWPRegistry::get('Template')->set('menu-replace', 0);
    MyWPRegistry::get('Controller')->set('stylesheets', array('news.css'));
  }
  function _get_config($key = null) {
    $_config = _framework_get_config('news');
    return is_null($key) ? $_config : $_config[$key];
  }
?>