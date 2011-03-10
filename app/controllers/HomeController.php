<?php
  class HomeController extends ApplicationController {
    public function index() {
      $this->set('stylesheets', array('index.css'));
      $this->push('javascripts', 'right-click.js');
      $this->push('javascripts', 'menu.js');
      $this->push('javascripts', 'index-menu.js');

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

      $photo_data = get_config('photo');
      $photo_count = 0;
      foreach ($photo_data['photos'] as $album => $photos)
        $photo_count += count($photos);
      $random_index = mt_rand(1, $photo_count);
      foreach ($photo_data['photos'] as $album => $photos) {
        $count_photos = count($photos);
        if ($random_index <= $count_photos) {
          $data['photo']['url'] = get_routes()->build_path('photo') .
                  '?a=' . urlencode($album) .
                  '#p' . $random_index;
          $data['photo']['img'] = $photos[$random_index - 1]['img'];
          $data['photo']['alt'] = htmlspecialchars($photos[$random_index - 1]['text']);
          break;
        }
        $random_index -= $count_photos;
      }
      $this->set('random-photo', $data['photo']);
    }
  }
?>
