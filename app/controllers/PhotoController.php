<?php
  class PhotoController extends ApplicationController {

    private $data;

    public function  __construct($params) {
      parent::__construct($params);

      $this->data = get_config('photo');
    }

    public function index() {
      $this->_layout = 'photo';
      $this->set('stylesheets', array('photo.css'));

      $this->set('menu-replace', 2);
      $this->set('title', $this->data['title']);

      //checking and selecting album
      $albums = array_keys($this->data['photos']);
      $selected_album = null;
      if (array_key_exists('a', $_GET))
        foreach ($albums as $i => $v)
          if ($_GET['a'] == $v) {
            $selected_album = $v;
            unset($albums[$i]);
            break;
          }
       if (is_null($selected_album))
         $selected_album = array_shift ($albums);
       $this->set('albums', $albums);
       $this->set('album-selected', $selected_album);
    }
  }
?>
