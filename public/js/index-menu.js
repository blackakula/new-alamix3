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

  var slideElement = function(speed) {
    var aniElement = $(this).find('.container')
    
    aniElement.clearQueue()
    aniElement.stop()
    if (speed == 0) return

    var aniLeft = aniElement.position().left
    var maxLeft = $(this).width() - aniElement.width()

    if (speed < 0 && aniLeft >= 0) {
      if (aniLeft > 0) aniElement.css({left: 0})
      return
    }
    if (speed > 0 && aniLeft <= maxLeft) {
      if (aniLeft < maxLeft) aniElement.css({left: maxLeft})
      return
    }

    var goal = (speed > 0 ) ? maxLeft : 0
    aniElement.animate({left: goal}, (aniLeft - goal) * actionSpeed / speed)
  }

  var calcSpeed = function(e) {
    var el = $(this)
    var aniElement = $('.i-menu .container')
    var elWidth = el.width()

    if (aniElement.width() <= elWidth) return

    var sidesWidth = elWidth * slideWidth
    if (sidesWidth == 0) return
    var elLeft = el.offset().left;

    var hitPosition = 0

    var slideBorder = elLeft + sidesWidth
    if (e.pageX < slideBorder)
      hitPosition = (e.pageX - slideBorder) / sidesWidth

    var slideBorder = elLeft + elWidth - sidesWidth;
    if (e.pageX > slideBorder)
      hitPosition = (e.pageX - slideBorder) / sidesWidth

    return (hitPosition == 0) ? 0 :
              (slideSpeedRange[1] - slideSpeedRange[0]) * hitPosition +
              slideSpeedRange[0] * ((hitPosition < 0) ? -1 : 1)
  }

  $('.i-menu').mousemove(function(event) {
    var speed = calcSpeed.call(this, event)
    slideElement.call(this, speed)
  })

  $('.i-menu').mouseout(function(event) {
    if (checkMouseHover.call(this, event)) {
      slideElement.call(this, 0)
    }
  })

  $(window).resize(function() {
    var aniElement = $('.i-menu .container')
    var maxLeft = $('.i-menu').width() - aniElement.width()
    if (maxLeft > 0) maxLeft = 0
    
    if (aniElement.position().left < maxLeft) aniElement.css({left: maxLeft})
  })
})