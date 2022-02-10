const $ = require('/assets/js/Jquery.js');
global.$ = global.jQuery = $;


import Filter from './filter.js'


new Filter(document.querySelector('.js-filter'))