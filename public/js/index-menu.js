$(function() {
  var titleMargin = 12
  var actionSpeed = 400

  $('.i-menu .list').each(function() {
    var e = $(this)
    var h = e.height()
    e.height(0)
    e.attr('maxHeight', h)
    e.css({marginTop: titleMargin})
  })
  $('.i-menu .container').delegate('.submenu', 'mouseover', function(event) {
    if ($(this).find('*').andSelf().not(function() {
      return (this != event.relatedTarget)
    }).size() == 0) {
      var e = $(this).find('.list')
      e.clearQueue()
      e.stop()
      e.animate({height: e.attr('maxHeight'), marginTop: 0}, actionSpeed)
    }
  })
  $('.i-menu .container').delegate('.submenu', 'mouseout', function(event) {
    if ($(this).find('*').andSelf().not(function() {
      return (this != event.relatedTarget)
    }).size() == 0) {
      var e = $(this).find('.list')
      e.clearQueue()
      e.stop()
      e.animate({height: 0, marginTop: titleMargin}, actionSpeed)
    }
  })
})