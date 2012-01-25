<?php
  $r = get_routes();
  
  $r->named('root', '/', array('controller' => 'home'));

  $r->named('photo', '/photo', array('controller' => 'photo'));
  $r->connect('/ajax/photo.json', array('controller' => 'photo', 'action' => 'thumbs'));

  $r->named('about', '/about', array('controller' => 'about'));
  $r->connect('/images.php', array('controller' => 'about', 'action' => 'gallery'));

  $r->named('links', '/links', array('controller' => 'links'));

  $r->named('heart', '/heart', array('controller' => 'simple', 'action' => 'heart'));
  $r->named('portfolio', '/portfolio', array('controller' => 'simple', 'action' => 'portfolio'));

  $r->named('mix', '/mix/');
  $r->named('news', '/news/');
?>
