export const timer = (first, second) => {
  if (typeof first === 'number') {
    return setTimeout(() => second && second(), first);
  }
  return setTimeout(() => first && first(), 0);
};

export const interval = (ms, cb) => {
  return setInterval(() => cb(), ms);
};

export const until = (cond, cb) => {
  const intervalHandle = interval(1, () => {
    if (cond()) {
      cb();
      clearInterval(intervalHandle);
    }
  });
}