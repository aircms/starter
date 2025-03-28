const timer = {
  timeout(first, second) {
    if (typeof first === 'number') {
      return setTimeout(() => second && second(), first);
    }
    return setTimeout(() => first && first(), 0);
  },

  interval(ms, cb) {
    return setInterval(() => cb(), ms);
  },

  immediate(cb) {
    setTimeout(cb && cb(), 0);
  },

  destroy(id) {
    tryCatch(() => clearInterval(id));
    tryCatch(() => clearTimeout(id));
  }
};