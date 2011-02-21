<?php
  class ApplicationController extends Controller {
    public function __construct($params) {
      parent::__construct($params);
      /* Here is your code to do for all controllers */
      $this->header()->charset();
      $this->set('javascripts', array('jquery-1.5.min.js'));
      
      $this->set('alamix-menu', array(
          array('новини', '#'),
          array('медіа', '#'),
          array('фото', '#'),
          array('лінки', '#'),
          array('аля про', '#')
      ));
    }
  }
?>
