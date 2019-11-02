import VueRouter from 'vue-router';
// Default SortableJS
import Sortable from 'vue-sortable';
import User from './Helper/User';
import Vuelidate from 'vuelidate';
import VueSimplemde from 'vue-simplemde';
import 'simplemde/dist/simplemde.min.css';
import VueDraggable from 'vue-draggable'


Vue.use(Vuelidate);
 Vue.use(VueDraggable);
 
Vue.component('vue-simplemde', VueSimplemde);
Vue.use(Sortable);

// // Core SortableJS (without default plugins)
// import Sortable from 'sortablejs/modular/sortable.core.esm.js';

// // Complete SortableJS (with all plugins)
// import Sortable from 'sortablejs/modular/sortable.complete.esm.js';
window._ = require('lodash');

// to import vuerouter in windo
Vue.use(VueRouter);

window.User = User;

 window.EventBus = new Vue();
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
    require('admin-lte');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let jwtToken = `Bearer ${localStorage.getItem('token')}}`;
let csrf = document.querySelector('meta[name="csrf-token"]');
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]');
axios.defaults.headers.common = {'Authorization': `bearer ${localStorage.getItem('token')}}`}
export default axios;

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
