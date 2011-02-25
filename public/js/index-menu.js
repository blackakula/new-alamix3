$(function() {
  var titleMargin = 12
  var actionSpeed = 400

  $('.i-menu .list').each(function() {
    var e = $(this)
    var h = e.height()
    e.height(0)
    e.attr('maxHeight', h)
  })
  $('.i-menu .title').css({marginBottom: titleMargin})

  var iMenuAnimation = function(over, event) {
    if ($(this).find('*').andSelf().not(function() {
      return (this != event.relatedTarget)
    }).size() == 0) {
      var e = $(this).find('.list, .title')
      e.clearQueue()
      e.stop()
      e = $(this).find('.list')
      e.animate({height: (over ? e.attr('maxHeight') : 0)})
      $(this).find('.title').animate({marginBottom: (over ? 0 : titleMargin)})
    }
  }

  $('.i-menu .container').delegate('.submenu', 'mouseover', function(event) {
    iMenuAnimation.call(this, true, event)
  })
  $('.i-menu .container').delegate('.submenu', 'mouseout', function(event) {
    iMenuAnimation.call(this, false, event)
  })

  $('.i-menu').css({overflow: 'hidden'})
})