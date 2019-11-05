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
        path: '/todos',
        name:'todos',
        component: require('../components/pages/Todos.vue').default
    },
    {
        path: '/SingleTodo/:id',
        name:'SingleTodo',
        component: require('../components/pages/SingleTodo.vue').default
    },

    {
        path: '/contact',
        name:'contact',
        component: require('../components/pages/Contact.vue').default
    },

    {
        path: '/about',
        name:'about',
        component: require('../components/pages/About.vue').default
    },
]

export default new VueRouter({
    mode: 'history',
    routes
});