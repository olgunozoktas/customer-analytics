require('./bootstrap');
require('alpinejs');

import Vue from "vue";
window.baseUrl = document.head.querySelector('meta[name="baseUrl"]').content;

/**
 * Will be used for global event handler
 */
window.Fire = new Vue();


/**
 * A simple JavaScript plugin to show alerts
 */
import swal from "sweetalert2";
const toast = swal.mixin({
    toast: true,
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
});

window.toast = toast;

const customers = new Vue({
    el: '#customers',
    components: {
        'customers': require('./components/CustomerComponent.vue').default
    }
})
