<?php
  class PhotoController extends ApplicationController {
    public function index() {
      $this->_layout = 'photo';
      $this->set('stylesheets', array('photo.css'));

      $this->set('menu-replace', 2);
    }
  }
?>
