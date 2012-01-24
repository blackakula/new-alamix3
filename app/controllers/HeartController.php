<?php
  class HeartController extends ApplicationController {
    public function index() {
      $this->_layout = 'heart';
      $this->set('stylesheets', array('heart.css'));
    }
  }