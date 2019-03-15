Vue.use(VueRouter);

const dive_log = Vue.component('dive-log', require('../../components/pages/DiveLog').default);

const routes = [
    {path: '/dive-log/create', component: dive_log},
];

const router = new VueRouter({
    mode : 'history',
    routes // short for `routes: routes`
});

let app = new Vue({
    el: '#log_app',
    router,
});