<?php
  class LinksController extends ApplicationController {
    const DELIMITER = '<***>';
    private $data;

    public function  __construct($params) {
      parent::__construct($params);

      $this->data = get_config('links');
    }

    public function index() {
      $this->set('stylesheets', array('links.css'));
      $this->push('javascripts', 'right-click.js');
      $this->push('javascripts', 'menu.js');

      $this->set('menu-replace', 3);

      $this->set('title', $this->data['title']);

      $columns = array();
      $columnIndex = 0;
      
      foreach ($this->data['content'] as $item) {
        $this->_newColumn($columnIndex, $columns);

        $column_item = &$columns[$columnIndex];
        if (count($column_item) > 0) $column_item[] = array('space');
        $column_item[] = array('squares', $item['squares']);
        $link = !isset($item['link']) || empty($item['link']) ? null : $item['link'];
        $column_item[] = array('title', array($item['title'], $link));

        foreach (explode(self::DELIMITER, $item['text']) as $part) {
          $part = trim($part);
          if (!empty($part)) {
            $this->_newColumn($columnIndex, $columns);
            if ($link) {
              $part = str_replace('<-@->', $link, $part);
            }
            $columns[$columnIndex][] = array('text', $part);
          }
          ++$columnIndex;
        }
        --$columnIndex;
      }
      $this->set('columns', $columns);
    }
  
    private function _newColumn($column_index, &$columns) {
     if (!array_key_exists($column_index, $columns))
     $columns[$column_index] = array();
    }
  }
?>
