import VueRouter from 'vue-router';
window.Vue = require('vue');

Vue.use(VueRouter);

let routes = [

    {
        path: '/login',
        name:'login',
        component: require('../components/login/Login.vue').default
    },
    {
        path: '/logout',
        name:'logout',
        component: require('../components/login/Logout.vue').default
    },
    {
        path: '/signup',
        name:'signup',
        component: require('../components/login/Signup.vue').default
    },
    {
        path: '/tasks',
        name:'tasks',
        component: require('../components/pages/Task.vue').default
    },
]

export default new VueRouter({
    mode: 'history',
    routes
});