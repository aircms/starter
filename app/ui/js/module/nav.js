import $ from "jquery";

export const nav = {
  callback: [],
  beforeCallback: [],
  mainSelector: '[role="main"]',
  lastUrl: location.pathname + location.search,
  interval: null,

  reload(dryRun) {
    this.go(location.pathname + location.search, dryRun);
  },

  go(url, dryRun) {
    return new Promise((resolve) => {
      history.pushState({}, null, url);
      this.lastUrl = location.pathname + location.search;

      this.beforeCallback.forEach((cb) => cb());

      if (!dryRun) {
        setTimeout(() => window.scrollTo(0, 0), 50);
      }

      const request = $.get(url).always((content) => {
        content = content.responseText ? content.responseText : content;
        $(this.mainSelector).html(content);

        try {
          $('title').text(JSON.parse(request.getResponseHeader('title')));
        } catch {
        }

        try {
          for (const [lang, link] of Object.entries(JSON.parse(request.getResponseHeader('language-links')) || {})) {
            $('[data-language-link="' + lang + '"]').attr('href', link);
          }
        } catch {
        }

        resolve(request, content);
        this.callback.forEach((cb) => cb(request, content));
      });
    });
  },

  watch() {
    if (this.interval) {
      return;
    }

    this.interval = setInterval(() => {
      if (this.lastUrl !== location.pathname + location.search) {
        this.go(location.pathname + location.search);
      }
    }, 10);

    $(document).on('click', 'a[href]', (e) => {
      const element = $(e.currentTarget);

      if (element.data('force') || element.attr('target') === '_blank' || element.attr('href').startsWith('#')) {
        return;
      }

      if (element.attr('data-nav-deep') !== undefined
        && !$(e.currentTarget).is(e.target)
        && !$(e.target).hasClass('category-title')) {
        return;
      }

      if (element.attr('href')) {
        this.go(element.attr('href'));
      }

      element.blur();
      return false;
    });
  }
};