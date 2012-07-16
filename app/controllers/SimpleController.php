<?php
  class SimpleController extends ApplicationController {
    private $data;

    protected function _prepareData($configName) {
      $this->data = get_config($configName);
      $this->set('title', $this->data['title']);
    }

    public function heart() {
      $this->_prepareData('heart');
      $this->set('hide_menu', 'heart');
      $this->set('stylesheets', array('heart.css'));
    }

    public function portfolio() {
      $this->_prepareData('portfolio');
      $this->set('stylesheets', array('simple.css'));
      $this->push('javascripts', 'portfolio.js');
      foreach ($this->data['content'] as &$row) {
          foreach ($row['items'] as &$item) {
              if (is_array($item) && isset($item['document_id'])) {
                  if (!isset($item['color'])) {
                      $item['color'] = '000000';
                  }
                  $item = '<div style="background-color:#' . $item['color'] . '"><object style="width:546px;height:346px" ><param name="movie" value="http://static.issuu.com/webembed/viewers/style1/v2/IssuuReader.swf?mode=mini&amp;embedBackground=%23' . $item['color'] . '&amp;backgroundColor=%23222222&amp;documentId=' . $item['document_id'] . '" /><param name="allowfullscreen" value="true"/><param name="menu" value="false"/><param name="wmode" value="transparent"/><embed src="http://static.issuu.com/webembed/viewers/style1/v2/IssuuReader.swf" type="application/x-shockwave-flash" allowfullscreen="true" menu="false" wmode="transparent" style="width:546px;height:346px" flashvars="mode=mini&amp;embedBackground=%23' . $item['color'] . '&amp;backgroundColor=%23222222&amp;documentId=' . $item['document_id'] . '" /></object></div>';
              }
          }
      }
      $this->set('content', $this->data['content']);
    }
  }
