<?php
  class LinksController extends ApplicationController {
    private $data;

    public function  __construct($params) {
      parent::__construct($params);

      $this->data = get_config('links');
    }

    public function index() {
      $this->set('stylesheets', array('links.css'));
      $this->push('javascripts', 'right-click.js');
      $this->push('javascripts', 'menu.js');

      $this->set('menu-replace', 3);

      $this->set('title', $this->data['title']);
    }
  }
?>
