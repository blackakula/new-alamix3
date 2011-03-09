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
      $this->push('javascripts', 'right-click.js');
      $this->push('javascripts', 'jquery.gallery.js');

      $this->set('menu-replace', 2);
      $this->set('title', $this->data['title']);

      //checking and selecting album
      $albums = array_keys($this->data['photos']);
      $selected_album = null;
      $aParamName = 'a';
      if (array_key_exists($aParamName, $_GET))
        foreach ($albums as $i => $v)
          if ($_GET[$aParamName] == $v) {
            $selected_album = $v;
            unset($albums[$i]);
            break;
          }
      if (is_null($selected_album))
        $selected_album = array_shift ($albums);
      $this->set('albums', $albums);
      $this->set('album-selected', $selected_album);
      $this->push('copyrights', array('Codrops', 'http://tympanus.net/codrops/2010/05/23/fresh-sliding-thumbnails-gallery-with-jquery-php/'));
    }

    public function thumbs() {
      $aParamName = 'a';
      if (array_key_exists($aParamName, $_GET))
        if (array_key_exists($_GET[$aParamName], $this->data['photos'])) {
          $this->_layout = 'empty';
          $album = $this->data['photos'][$_GET[$aParamName]];
          $response = array();
          foreach ($album as $photo)
            array_push($response, array(
                'src' => $photo['thumb'],
                'alt' => $photo['img'],
                'desc' => $photo['text'],
            ));
          get_header()->format('application/json');
          $this->set('response', json_encode($response));
          return;
        }

      get_header()->page404();
    }
  }
?>
