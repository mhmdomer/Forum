window._ = require('lodash');

window.$ = window.jQuery = require('jquery');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.axios = require('axios');
window.Vue = require('vue');

window.events = new Vue();
window.flash = function(message, level = 'success') {
    window.events.$emit('flash', message, level)
};

let authorization = require('./authorization')

window.Vue.prototype.authorize = (...params) => {
    if(! window.App.signedIn) return false
    if(typeof params[0] == "string") {
        return authorization[params[0]](params[1])
    }
    return params[0](window.App.user)
}

Vue.prototype.signedIn = window.App.signedIn
