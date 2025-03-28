const nav = {
  lastUrl: location.pathname + location.search,
  interval: null,

  options: {
    target: '[role="main"]',
    scrollOnTop: true,
  },

  events: {
    requestBefore: [],
    requestAfter: [],
    contentBefore: [],
    contentAfter: []
  },

  reload() {
    this.go(location.pathname + location.search);
  },

  go(url) {
    history.pushState({}, null, url);
    this.lastUrl = location.pathname + location.search;

    this.events.requestBefore.forEach((cb) => cb());

    if (this.options.scrollOnTop) {
      timer.timeout(50, () => window.scrollTo(0, 0));
    }

    const request = $.get(url).always((content) => {
      content = content.responseText ? content.responseText : content;
      this.events.requestAfter.forEach((cb) => cb(request, content));
      this.events.contentBefore.forEach((cb) => cb(content));
      $(this.options.target).html(content);
      this.events.contentAfter.forEach((cb) => cb(content));
    });
  },

  on(event, cb) {
    this.events[event].push(cb);
  },

  start(options = {}) {
    if (this.interval) {
      return;
    }
    this.interval = setInterval(() => {
      if (this.lastUrl !== location.pathname + location.search) {
        this.go(location.pathname + location.search);
      }
    }, 10);

    options = {...this.options, ...options};

    $(document).on('click', 'a[href]', (e) => {
      const element = $(e.currentTarget);
      if (element.data('force') || element.attr('target') === '_blank' || element.attr('href').startsWith('#')) {
        return;
      }
      this.go(element.attr('href'));
      element.blur();
      return false;
    });

    return this;
  }
};