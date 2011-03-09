<?php
  $r = get_routes();
  $r->named('root', '/', array('controller' => 'home'));
  $r->named('photo', '/photo', array('controller' => 'photo'));
?>
