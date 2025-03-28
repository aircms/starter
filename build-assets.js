const filesJs = [
  // ...
  'js/vendor/jquery.min.js',
  'js/vendor/try-catch.js',
  'js/vendor/timer.js',
  'js/vendor/wait.js',
  'js/vendor/nav.js',
  'js/vendor/bg-image.js',
  'js/main.js',
];

const filesCss = [
  // ...
  'css/custom.css',
];

//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////

const fs = require('fs');
const path = require('path');
const https = require('https');
const querystring = require('querystring');

let buildFilename = 'www/assets/ui/build.js';
let filesToMerge = filesJs;

if (process.argv.indexOf('--css') !== -1) {
  buildFilename = 'www/assets/ui/build.css';
  filesToMerge = filesCss;
}

const minify = (code, type) => {
  return new Promise((resolve, reject) => {
    const req = https.request({
      hostname: 'www.toptal.com',
      path: type === 'js' ? '/developers/javascript-minifier/api/raw' : '/developers/cssminifier/api/raw',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      method: 'POST',
    }, (res) => {
      let data = '';
      res.setEncoding('utf8');
      res.on('data', (chunk) => data += chunk);
      res.on('end', () => resolve(data));
    });
    req.on('error', (error) => reject(error));
    req.write(querystring.stringify({input: code}));
    req.end();
  });
}
const outputFilePath = path.resolve(__dirname, buildFilename);
const mergeFiles = async () => {
  console.log('Date:', (new Date()).toUTCString());
  const content = [];
  for (const filePath of filesToMerge) {
    const fileContent = fs.readFileSync(path.resolve(__dirname, 'app/ui/', filePath), 'utf8');
    if (filePath.endsWith('.min.js')) {
      content.push(fileContent);
    } else {
      content.push(await minify(fileContent, "js"));
    }
  }
  fs.writeFileSync(outputFilePath, content.join(';'));
  console.log('Files merged into', outputFilePath);
}
mergeFiles();
if (process.argv.indexOf('--watch') !== -1) {
  filesToMerge.forEach((filePath) => fs.watch(path.resolve(__dirname, 'app/ui/' + filePath), (eventType) => {
    if (eventType === 'change') {
      mergeFiles();
    }
  }));
  console.log('Watching for file changes...');
}