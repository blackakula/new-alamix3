<?php
  class AboutController extends ApplicationController {
    private $data;

    public function  __construct($params) {
      parent::__construct($params);

      $this->data = get_config('about');
    }

    public function index() {
      $this->set('stylesheets', array('about.css'));
      $this->push('javascripts', 'right-click.js');
      $this->push('javascripts', 'menu.js');
      $this->push('javascripts', 'index-menu.js');
      $this->push('javascripts', 'about.js');
      
      $this->set('menu-replace', 4);

      $this->set('title', $this->data['title']);
      $this->set('content', $this->data['content']);

      $this->set('contacts', $this->data['contacts']);
    }

    public function gallery() {
      $this->_layout = 'empty';
      $this->set('response', 'files=' . implode('|',$this->data['gallery']));
    }
  }
?>
