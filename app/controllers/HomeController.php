<?php
  class HomeController extends ApplicationController {
    public function index() {
      $this->set('stylesheets', array('index.css'));

      $data = get_config('index');
      $this->set('title', $data['title']);
    }
  }
?>
