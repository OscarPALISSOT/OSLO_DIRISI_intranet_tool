const $ = require('/assets/js/Jquery.js');
global.$ = global.jQuery = $;


import Filter from './filter.js'

new Filter(document.querySelector('.js-filter'))

import CrudAjax from './crudAjax.js'

new CrudAjax(document.querySelector('.js-Ajax'))


$(function(){
    $(".chosen-select").chosen({
        width: '100%'
    });
})
