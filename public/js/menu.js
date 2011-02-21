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

  var resizeMenu = function() {
    var k = $('.menu').width() / 39
    $('.menu').height(k * 9)
    $('.menu').css({fontSize: k + 'pt'})
    
    var item = $('.menu .item').height()
    var itemText = .34 * item
    var itemTab = ($('.menu').height() - itemText) / 2
    var itemTail = item - itemText - itemTab
    
    $('.up .head, .down .tail').height(itemTab)
    $('.item .text').height(itemText + 1)
    $('.down .head, .up .tail').height(itemTail)

    //border radius
    var borderRadius = (.15 * $('.menu .item').width()) + 'px ' + (.15 * item) + 'px'
    $('.item, .tail').css(roundCss(borderRadius, 'bottom'))
    $('.down, .down .head').css(roundCss(borderRadius, 'top'))
  }

  resizeMenu()
  $(window).resize(resizeMenu)
})