Vue.use(VueRouter);

const dive_log = Vue.component('dive-log', require('../../components/pages/DiveLog').default);

const routes = [
    {path: '/dive-log/create', component: dive_log, props: {user: user}},
];

const router = new VueRouter({
    mode : 'history',
    routes // short for `routes: routes`
});

let app = new Vue({
    el: '#log_app',
    data: {
        user: {},
    },
    router,
    mounted() {
        this.checkUser();
    },
    methods: {
        checkUser: function () {
            Axios.post('/api/dive-log/user', {

            }).then(function (response) {
                app.user = response.data.user;
            }).catch(function (error) {
                console.log(error);
            });
        },
    },
});