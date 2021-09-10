require('./bootstrap');
require('alpinejs');

import Vue from "vue";
window.baseUrl = document.head.querySelector('meta[name="baseUrl"]').content;

const customers = new Vue({
    el: '#customers',
    components: {
        'customers': require('./components/CustomerComponent.vue').default
    }
})
