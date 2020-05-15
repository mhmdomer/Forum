import './bootstrap';

Vue.component('flash', require('./components/FlashMessage.vue').default);
Vue.component('thread-view', require('./pages/Thread.vue').default);
Vue.component('user-notifications', require('./components/UserNotifications').default)
Vue.component('avatar-form', require('./components/AvatarForm').default)
Vue.component('favorite', require('./components/Favorite').default)

const app = new Vue({
    el: '#app',
});

require('./navbar')
