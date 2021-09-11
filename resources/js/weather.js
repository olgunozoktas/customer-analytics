require('./bootstrap');
require('alpinejs');

import Vue from "vue";
window.baseUrl = document.head.querySelector('meta[name="baseUrl"]').content;

const weathers = new Vue({
    el: '#weathers',
    components: {
        'weathers': require('./components/WeatherComponent.vue').default
    }
})
