require('./bootstrap');

window.Vue = require('vue');

const VueCookie = require('vue-cookie');
Vue.use(VueCookie);

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import Weather from './components/Weather';

const app = new Vue({
    el: '#app',
    components: {
        'weather': Weather
    }
});
