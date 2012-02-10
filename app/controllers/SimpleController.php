<?php
  class SimpleController extends ApplicationController {
    public function heart() {
      $this->set('hide_menu', 'heart');
      $this->set('stylesheets', array('heart.css'));
    }

    public function portfolio() {
      $this->set('stylesheets', array('simple.css'));
    }
  }