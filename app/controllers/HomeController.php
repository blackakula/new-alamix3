<?php
  class HomeController extends ApplicationController {
    public function index() {
      $this->set('stylesheets', array('index.css'));
      $this->push('javascripts', 'menu.js');

      $data = get_config('index');
      $this->set('title', $data['title']);
      $this->set('index-menu', $data['menu']);

      $content = $data['content'];
      foreach ($content as $i => $item) {
        if (!array_key_exists('squares', $item)) {
          $content[$i]['squares'] = array(0, 1, 2);
        }
        $item['text'] = str_replace(
                '<--->',
                '<a href="<-@->" class="more">далі &#187;</a>',
                $item['text']
        );
        $content[$i]['url'] = htmlspecialchars($item['url']);
        $content[$i]['text'] = str_replace('<-@->', $content[$i]['url'], $item['text']);
      }
      $this->set('content', $content);
    }
  }
?>
