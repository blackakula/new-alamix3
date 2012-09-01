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
              $decorator = '<div class="subitem">%item%<div class="subitem-text">%text%</div></div>';
              $text = '';
              if (is_array($item)) {
                  if (isset($item['text'])) {
                      $text = $item['text'];
                  } else if (array_values($item) === $item && count($item) > 1) {
                      $text = $item[count($item) - 1];
                  }
                  if (isset($item['document_id'])) {
                      if (!isset($item['color'])) {
                          $item['color'] = '000000';
                      }
                      if (!isset($item['width'])) {
                          $item['width'] = '460';
                      }
                      $pageString = isset($item['page']) ? ('pageNumber=' . $item['page'] . '&amp;') : '';
                      $layout = isset($item['layout']) && $item['layout'] ? 'viewMode=singlePage&amp;' : '';
                      $item = '<div style="background-color:#' . $item['color'] . '" class="rounded"><object style="width:' . $item['width'] . 'px;height:291px" ><param name="movie" value="http://static.issuu.com/webembed/viewers/style1/v2/IssuuReader.swf?mode=mini&amp;'
                          . $pageString . $layout . 'embedBackground=%23' . $item['color'] . '&amp;backgroundColor=%23222222&amp;documentId=' . $item['document_id']
                          . '" /><param name="allowfullscreen" value="true"/><param name="menu" value="false"/><param name="wmode" value="transparent"/><embed src="http://static.issuu.com/webembed/viewers/style1/v2/IssuuReader.swf" type="application/x-shockwave-flash" allowfullscreen="true" menu="false" wmode="transparent" style="width:'
                          . $item['width'] . 'px;height:291px" flashvars="mode=mini&amp;'
                          . $pageString . $layout . 'embedBackground=%23' . $item['color'] . '&amp;backgroundColor=%23222222&amp;documentId=' . $item['document_id']
                          . '" /></object></div>';
                  } else if (isset($item['description'])) {
                      $decorator = '%item%';
                      $item = '<div class="item-description item-description-inline">' . $item['description'] . '</div>';
                  } else {
                      $item = array_shift($item);
                  }
              }
              $item = str_replace(array('%item%', '%text%'), array($item, $text), $decorator);
          }
      }
      $this->set('content', $this->data['content']);
    }
  }
