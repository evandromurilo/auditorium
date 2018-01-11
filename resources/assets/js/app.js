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

Vue.component('example', require('./components/Example.vue'));
Vue.component('notification', require('./components/Notification.vue'));
Vue.component('notification-item', require('./components/NotificationItem.vue'));
Vue.component('new-call', require('./components/NewCall.vue'));
Vue.component('call', require('./components/Call.vue'));
Vue.component('call-member', require('./components/CallMember.vue'));
Vue.component('call-message', require('./components/CallMessage.vue'));
Vue.component('requirements', require('./components/Requirements.vue'));
Vue.component('blocked-dates', require('./components/BlockedDates.vue'));

const app = new Vue({
    el: '#app'
});
