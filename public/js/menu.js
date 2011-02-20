$(function() {
  for (var i=0; i < 5; ++i) {
    $('.menu .item' + i).attr('itemIndex', i)
    $('.menu').delegate('.item' + i, 'hover', function() {
      $('.menu .item:not(.item' + $(this).attr('itemIndex') + ')').toggleClass('light' + $(this).attr('itemIndex'))
    })
  }
})