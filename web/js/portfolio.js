$(function() {
  $('.portfolio .portfolio-item .item-content').slideUp(0)
  $($('.portfolio .portfolio-item .item-content')[0]).slideToggle(0)

  var speed = 600
  $('.portfolio .portfolio-item h2.title a').click(function(event) {
    event.preventDefault()

    var clickedElement = this
    $('.portfolio .portfolio-item h2.title a').not(this).each(function() {
      var $parent = $(this).parents('.portfolio-item')
      $parent.find('.title').removeClass('selected')
      $parent.find('.item-content').slideUp(speed)
    })
    var $this = $(this)
    $this.parents('.title').toggleClass('selected')
    $this.parents('.portfolio-item').find('.item-content').slideToggle(speed)
  })
})