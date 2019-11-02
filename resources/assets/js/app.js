require('./bootstrap');

window.Vue = require('vue');
import vuetify from '../plugins/vuetify' // path to vuetify export
import router from './Router/routes';



Vue.component('AppHome', require('./components/AppHome').default);
 

const app = new Vue({
    el: '#app',
     vuetify,
    router:router
});
