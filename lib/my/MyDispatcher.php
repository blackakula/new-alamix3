<?php
  class MyDispatcher extends Dispatcher {
    public static function control() {
      parent::control();
      if (!get_header()->is404()) {
        return;
      }

      self::$contoller->set('show_menu_and_logo', false);
      self::$contoller->set('stylesheets', array('404.css'));
      self::$contoller->set('javascripts', array());
      self::$contoller->set('title', 'помилка 404');
    }
  }
?>
