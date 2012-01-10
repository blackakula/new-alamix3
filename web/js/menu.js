$(function() {
  for (var i=0; i < 5; ++i) {
    $('.menu .item' + i).attr('itemIndex', i)
    $('.menu').delegate('.item' + i, 'hover', function() {
      $('.menu .item:not(.item' + $(this).attr('itemIndex') + ')').toggleClass('light' + $(this).attr('itemIndex'))
    })
  }

  var contentWidth = 80
  $('.menu').css({
    width: contentWidth + '%',
    marginLeft: (- contentWidth / 2) + '%'
  })

  var roundCss = function(radius, h, w) {
    if (typeof w == 'undefined')
      return jQuery.extend(arguments.callee(radius, h, 'left'), arguments.callee(radius, h, 'right'))
    var css = {}
    css['border-' + h + '-' + w + '-radius'] = radius
    css['-moz-border-radius-' + h + w] = radius
    css['-webkit-border-radius-' + h + w] = radius
    return css
  }

  var resizeRandomImage = function() {
    var $this = $(this)
    var $realWidth = $this.attr('realWidth')
    if ($realWidth) {
      var $maxWidth = $this.parents('.random-photo-box').width()
      $this.width($maxWidth > $realWidth ? $realWidth : $maxWidth)
    }
  }

  var resizeMenu = function() {
    var k = $('.menu').width() / 44
    $('.menu').height(k * 9)
    $('.menu').css({fontSize: k + 'pt'})
    
    var item = $('.menu .item').height()
    var itemText = .34 * item
    var itemTab = ($('.menu').height() - itemText) / 2
    var itemTail = item - itemText - itemTab
    var itemTextHeight = itemText + 1
    
    $('.menu .up .head, .menu .down .tail').height(itemTab)
    $('.menu .item .text').height(itemTextHeight)
    $('.menu .down .head, .menu .up .tail').height(itemTail)
    var logoMarginTop = itemTab / 2;
    var logoHeight = itemText + itemTab * 3 / 2;
    $('.logo').css({marginTop: logoMarginTop})
    $('.logo img').css({height: logoHeight})
    $('.right .content').css({marginTop: 2 * itemTab + itemText + 60 - logoMarginTop - logoHeight})

    //border radius
    var menuItemWidth = $('.menu .item').width();
    var borderRadius = (.15 * menuItemWidth) + 'px ' + (.15 * item) + 'px'
    $('.menu .item, .menu .tail').css(roundCss(borderRadius, 'bottom'))
    $('.menu .down, .menu .down .head').css(roundCss(borderRadius, 'top'))

    var heartMenuItem = $('.item.item-heart');
    if (heartMenuItem) {
      //border radius
      var heartMenuItemWidth = heartMenuItem.width();
      var borderRadius = (.15 * heartMenuItemWidth) + 'px ' + (.15 * item * heartMenuItemWidth / menuItemWidth) + 'px'
      $('.menu .item.item-heart, .menu .item.item-heart .tail').css(roundCss(borderRadius, 'bottom'))
      $('.menu .item.item-heart.down, .menu .item.item-heart.down .head').css(roundCss(borderRadius, 'top'))
      $('.menu .item.item-heart img').css({
        height: Math.round(itemTextHeight * .6) + 'px',
        marginTop: (itemTextHeight * .2) + 'px'
      });
    }

    //random photo
    $('.random-photo-box img').each(resizeRandomImage)
  }

  $('.random-photo-box img').load(function() {
    var $this = $(this)
    $this.attr('realWidth', $this.width())
    resizeRandomImage.call(this)
  })

  resizeMenu()
  $(window).resize(resizeMenu)
})