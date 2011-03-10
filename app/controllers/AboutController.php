<?php
  class AboutController extends ApplicationController {
    public function index() {
      $this->set('stylesheets', array('about.css'));
      $this->push('javascripts', 'right-click.js');
      $this->push('javascripts', 'menu.js');
      $this->push('javascripts', 'about.js');
      
      $this->set('menu-replace', 4);

      $data = get_config('about');
      $this->set('title', $data['title']);
      $this->set('content', $data['content']);
    }
  }
?>
