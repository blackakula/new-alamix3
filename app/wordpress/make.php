<?php
  
  $domain = 'http://al-mix.org.ua/';
  $cur_dir = realpath(dirname(__FILE__));
  $lib_dir = realpath($cur_dir . '/../../lib/my') . '/';
  include_once($lib_dir . 'Haml.php');

  function make_folder($in_dir, $out_dir, $skipMake = false) {
    $d = opendir($in_dir);
    while ($f = readdir($d)) {
      $isHaml = preg_match('/\.haml$/', $f) != 0;
      $isPhp = preg_match('/\.php$/', $f) != 0;
      if (!$isHaml && !$isPhp) {
        continue;
      }
      if ($skipMake && $isPhp && ($f == 'make.php')) {
        continue;
      }

      $php = file_get_contents($in_dir . '/' . $f);
      if ($isHaml) {
        $php = Haml::parse2($php);
      }
      
      $outFile = $out_dir . preg_replace('/\.haml$/', '.php', $f);
      if (is_file($outFile)) {
        $php = file_get_contents($outFile) . $php;
      }
      file_put_contents($outFile, $php);
    }
  }

  function clear_folder($dir) {
    $d = opendir($dir);
    while ($f = readdir($d)) {
      if ($f == '.' || $f == '..') {
        continue;
      }

      unlink($dir . '/' . $f);
    }
  }

  foreach (array(
      'mix' => array('alamix', 'AlaMix', $domain . 'mix/')
  ) as $folder => $theme) {

    $in_dir = realpath($cur_dir . '/' . $folder);
    $out_dir = realpath($cur_dir . '/../../' . $folder . '/wp-content/themes/' . $theme[0]) . '/';
    
    clear_folder($out_dir . '.');
    
    $style = <<<STYLE
/*
Theme Name: {$theme[1]}
Theme URI: {$theme[2]}
Description: This is the special theme "{$theme[1]}" designed for $domain
Author: Akulinin Sergey, Alina Mikhailova
Author URI: $domain
*/
STYLE;
//    $style .= "\n" . file_get_contents($in_dir . '/style.css');
//
    file_put_contents($out_dir . 'style.css', $style);
    make_folder($cur_dir, $out_dir, true);
    make_folder($in_dir, $out_dir);
  }
