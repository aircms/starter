wait.on('[data-image]', (el) => {
  $(el).css('background-image', "url('" + el.attr('data-image') + "')");
});