$(function() {
  $('.content .about-item .about-text').slideUp(0)

  var speed = 0
  $('.content .about-item h2.title a').click(function(event) {
    event.preventDefault()

    var clickedElement = this
    $('.content .about-item h2.title a').not(this).each(function() {
      var $parent = $(this).parents('.about-item')
      $parent.find('.title').removeClass('selected')
      $parent.find('.about-text').slideUp(speed)
    })
    var $this = $(this)
    $this.parents('.title').toggleClass('selected')
    $this.parents('.about-item').find('.about-text').slideToggle(speed)
  })

  $('.content .about-item h2.title a').first().click()
  speed = 600
})