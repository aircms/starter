nav.start({target: '[role="main"]'}).on('requestAfter', (r) => {
  tryCatch(() => document.title = JSON.parse(r.getResponseHeader('title')));
  tryCatch(() => {
    for (const [lang, link] of Object.entries(JSON.parse(r.getResponseHeader('language-links')) || {})) {
      $('[data-language-link="' + lang + '"]').attr('href', link);
    }
  })
});