<?php
  class ApplicationController extends Controller {
    public function __construct($params) {
      parent::__construct($params);
      /* Here is your code to do for all controllers */
      $this->header()->charset();

      Template::setIMG(get_config('IMG_PATH'));

      $this->set('javascripts', array('jquery-1.5.min.js'));

      $r = get_routes();
      $this->set('alamix-menu', array(
          array('новини', '#novyny'),
          array('мікс', $r->build_path('mix')),
          array('фото', $r->build_path('photo')),
          array('лінки', '#linky'),
          array('аля про', $r->build_path('about')),
      ));

      $this->set('copyrights', array(
          array('Alina Mikhailova', 'mailto:alya.mikhailova@gmail.com', 'idea, design, content'),
          array('Sergey Akulinin', 'mailto:blackakula@gmail.com', 'development: php, html, css, javascript'),
      ));
    }
  }
?>
