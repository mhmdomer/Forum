import './bootstrap';

Vue.component('alert', require('./components/AlertComponent.vue').default);
Vue.component('reply', require('./components/Reply.vue').default);
Vue.component('favorite', require('./components/Favorite.vue').default);
Vue.component('dropdown', require('./components/DropDown.vue').default);

const app = new Vue({
    el: '#app',
});

require('./navbar')
