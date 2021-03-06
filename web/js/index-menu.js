$(function() {
  var titleMargin = 12
  var actionSpeed = 400

  var slideWidth = .24
  var slideSpeedRange = [20, 300]

  $('.i-menu .list').each(function() {
    var e = $(this)
    var h = e.height()
    e.height(0)
    e.attr('maxHeight', h)
  })
  $('.i-menu .title').css({marginBottom: titleMargin})

  var checkMouseHover = function(event) {
    return $(this).find('*').andSelf().not(function() {
      return (this != event.relatedTarget)
    }).size() == 0
  }

  var iMenuAnimation = function(over, event) {
    if (checkMouseHover.call(this, event)) {
      var e = $(this).find('.list, .title')
      e.clearQueue()
      e.stop()
      e = $(this).find('.list')
      e.animate({height: (over ? e.attr('maxHeight') : 0)})
      $(this).find('.title').animate({marginBottom: (over ? 0 : titleMargin)}, actionSpeed)
    }
  }

  $('.i-menu .container').delegate('.submenu', 'mouseover', function(event) {
    iMenuAnimation.call(this, true, event)
  })
  $('.i-menu .container').delegate('.submenu', 'mouseout', function(event) {
    iMenuAnimation.call(this, false, event)
  })

  $('.i-menu').css({overflow: 'hidden'})

  var maxLeft = function() {
    var mLeft = $('.i-menu').width() - $('.i-menu .container').width()
    return (mLeft > 0) ? 0 : mLeft
  }

  $('.i-menu .container').delegate('.list a', 'mousemove', function(event) {
    event.stopPropagation()
  })

  $('.i-menu').mousemove(function(event) {
    var $this = $(this)
    var $width = $this.width()
    var aniElement = $('.i-menu .container')
    var side = aniElement.width() - aniElement.innerWidth()
    if (side > 0) side = -side
    if ($width >= aniElement.width() + side) return
    var $left = (event.pageX - $this.offset().left) / $width
    aniElement.css({left: maxLeft() * $left})
  })

  $(window).resize(function() {
    var aniElement = $('.i-menu .container')
    var side = (aniElement.width() - aniElement.innerWidth()) / 2
    if (side > 0) side = -side
    var mLeft = maxLeft() + side

    var positionLeft = aniElement.position().left
    //document.write(positionLeft + ' ' + side)
    if (positionLeft < mLeft) aniElement.css({left: mLeft})
    if (positionLeft > side) aniElement.css({left: side})
  })
})