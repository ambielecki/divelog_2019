Vue.component('dive-row', {
    template: `
        <tr>
            <td>{{ text }}</td>
            <td>{{ result }}</td>
        </tr>`,
    props: ['text', 'result']
});

Vue.component('dive-errors', {
    template: `
        <ul>
            <li is="dive-error" v-for="error_message in dive_error_messages" :message="error_message"></li>
        </ul>`,
    props: ['dive_error_messages']
});

Vue.component('dive-error', {
    template: '<li>{{ message }}</li>',
    props: ['message']
});

let app = new Vue({
    el: '#calculator',
    data: {
        calculator: {
            dive_1_depth: '',
            dive_1_time: '',
            surface_interval: '',
            dive_2_depth: '',
            dive_2_time: '',
        },
        results: {},
        text: {
            dive_1_max_time: 'Max Time for Dive 1: ',
            dive_1_pg: 'Pressure Group after Dive 1: ',
            post_si_pg: 'Pressure Group after Surface Interval: ',
            rnt: 'Residual Nitrogen Time: ',
            dive_2_max_time: 'Max Time for Dive 2: ',
            dive_2_pg: 'Pressure Group after Dive 2:',
        },

        error_messages: null
    }
});

document.addEventListener("DOMContentLoaded", function(event) {
    document.querySelector('#calculate_btn').addEventListener('click', function (event) {
        event.preventDefault();

        Axios.get('/api/calculator', {
            params: app.calculator,
        })
            .then(function (response) {
                app.results = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
    });
});
