<?php
  function loadSpecific() {
    MyWPRegistry::get('Template')->set('menu-replace', 1);
    MyWPRegistry::get('Controller')->set('stylesheets', array('mix.css'));
  }
?>