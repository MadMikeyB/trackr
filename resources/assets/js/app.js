
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('stopwatch', require('./components/Stopwatch.vue'));

const app = new Vue({
    el: '#app'
});

/**
 * Dead simple mobile menu
 */
let hamburger = document.querySelector(".menu__hamburger");
let mobileNav = document.querySelector(".mobile-menu");
let body = document.querySelector("body");

hamburger.addEventListener('click', function() {
  mobileNav.classList.toggle("mobile-menu--active");
  hamburger.classList.toggle("menu__hamburger--active");
  body.classList.toggle("js-mobile-nav-active");
}, false);

