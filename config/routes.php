<?php
  $r = get_routes();
  
  $r->named('root', '/', array('controller' => 'home'));
  
  $r->named('photo', '/photo', array('controller' => 'photo'));
  $r->connect('/ajax/photo.json', array('controller' => 'photo', 'action' => 'thumbs'));

  $r->named('about', '/about', array('controller' => 'about'));
  $r->connect('/images.php', array('controller' => 'about', 'action' => 'gallery'))
?>
