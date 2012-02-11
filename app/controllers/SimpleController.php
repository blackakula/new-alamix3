<?php
  class SimpleController extends ApplicationController {
    private $data;

    protected function _prepareData($configName) {
      $this->data = get_config($configName);
      $this->set('title', $this->data['title']);
    }

    public function heart() {
      $this->_prepareData('heart');
      $this->set('hide_menu', 'heart');
      $this->set('stylesheets', array('heart.css'));
    }

    public function portfolio() {
      $this->_prepareData('portfolio');
      $this->set('stylesheets', array('simple.css'));
      $this->set('content', $this->data['content']);
    }
  }