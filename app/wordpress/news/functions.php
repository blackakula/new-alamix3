<?php
  function loadSpecific() {
    MyWPRegistry::get('Template')->set('menu-replace', 0);
    MyWPRegistry::get('Controller')->set('stylesheets', array('news.css'));
  }
?>