<?php
  function loadSpecific() {
    MyWPRegistry::get('Template')->set('menu-replace', 0);
    MyWPRegistry::get('Controller')->set('stylesheets', array('news.css'));
  }
  function _get_config($key = null) {
    $_config = _framework_get_config('news');
    if (is_null($key)) {
      return $_config;
    }
    return array_key_exists($key, $_config) ? $_config[$key] : _get_wp_config($key);
  }
  function my_comments_performer($comment, $args, $depth) {

    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
      $tag = 'div';
      $add_below = 'comment';
    } else {
      $tag = 'li';
      $add_below = 'div-comment';
    }

    $comments_config = _get_config('post_comments')
?>
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
    <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
    <?php printf(__('<cite class="fn">%s</cite> <span class="says">' . $comments_config['says'] . ':</span>'), get_comment_author_link()) ?>
    </div>
<?php if ($comment->comment_approved == '0') : ?>
    <em class="comment-awaiting-moderation"><?php echo $comments_config['premoderation'] ?></em>
    <br />
<?php endif; ?>

    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
      <?php
        /* translators: 1: date, 2: time */
        printf( __($comments_config['date_str']), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(' . $comments_config['edit'] . ')'),'&nbsp;&nbsp;','' );
      ?>
    </div>

    <?php comment_text() ?>

    <div class="reply">
    <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
<?php
  }
?>