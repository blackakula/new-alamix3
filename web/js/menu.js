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
    var k = $('.menu').width() / 39
    $('.menu').height(k * 9)
    $('.menu').css({fontSize: k + 'pt'})
    
    var item = $('.menu .item').height()
    var itemText = .34 * item
    var itemTab = ($('.menu').height() - itemText) / 2
    var itemTail = item - itemText - itemTab
    
    $('.menu .up .head, .menu .down .tail').height(itemTab)
    $('.menu .item .text').height(itemText + 1)
    $('.menu .down .head, .menu .up .tail').height(itemTail)
    $('.logo').css({marginTop: itemTab / 2})
    $('.logo img').css({height: itemText + itemTail + itemTab / 2})
    $('.right .content').css({marginTop: itemTab - itemTail + 60})

    //border radius
    var borderRadius = (.15 * $('.menu .item').width()) + 'px ' + (.15 * item) + 'px'
    $('.menu .item, .menu .tail').css(roundCss(borderRadius, 'bottom'))
    $('.menu .down, .menu .down .head').css(roundCss(borderRadius, 'top'))

    //random photo
    $('.random-photo-box img').each(resizeRandomImage)

    //about page
    $('.right .contacts').css({marginTop: itemTail - itemTab - 40})
  }

  $('.random-photo-box img').load(function() {
    var $this = $(this)
    $this.attr('realWidth', $this.width())
    resizeRandomImage.call(this)
  })

  resizeMenu()
  $(window).resize(resizeMenu)
})