Vue.component('dive-row', {
    template: '<tr>' +
        '<td>{{ component_message }}</td>' +
        '<td>{{ component_result }}</td>' +
        '</tr>',
    props: ['component_message', 'component_result']
});

Vue.component('dive-errors', {
    template: '<ul>' +
        '<li is="dive-error" v-for="error_message in dive_error_messages" :message="error_message"></li>' +
        '</ul>',
    props: ['dive_error_messages']
});

Vue.component('dive-error', {
    template: '<li>{{ message }}</li>',
    props: ['message']
});

let app = new Vue({
    el: '#results',
    data: {
        results: {
            dive_1_max_time: {
                message: 'Max Time for Dive 1: ',
                result: ''
            },
            dive_1_pg: {
                message: 'Pressure Group after Dive 1: ',
                result: ''
            },
            post_si_pg: {
                message: 'Pressure Group after Surface Interval: ',
                result: ''
            },
            dive_2_max_time: {
                message: 'Max Time for Dive 2: ',
                result: ''
            },
            dive_2_pg: {
                message: 'Pressure Group after Dive 2:',
                result: ''
            },
        },
        error_messages: null
    }
});

document.addEventListener('DOMContentLoaded', function() {
    let submit_button = document.querySelector('#dive_calculator');

    submit_button.addEventListener('submit', function (event) {
        event.preventDefault();
        console.log('click');

        return false;
    });

    // TODO: Look into using cellIndex and <tr>'s instead
    let hover_cells = document.querySelectorAll('.hover_cell');

    hover_cells.forEach(function (hover_cell) {
        hover_cell.addEventListener('mouseover', function (event) {
            let target = event.target;
            let cell_index = target.cellIndex;
            let target_row = target.closest('tr');
            let row_index = target_row.rowIndex;
            let rows = target.closest('table').rows;

            if (cell_index !== 0) {
                for (let row of rows) {
                    row.cells[cell_index].classList.add('highlight_cell');
                }
            }

            if (row_index !== 0) {
                target_row.classList.add('highlight_cell');
            }

            if (cell_index !==0 && row_index !== 0) {
                event.target.classList.add('double_highlight');
            }
        });
    });

    hover_cells.forEach(function (hover_cell) {
        hover_cell.addEventListener('mouseout', function (event) {
            let target = event.target;
            let cell_index = target.cellIndex;

            let row = target.closest('tr');
            let rows = target.closest('table').rows;

            for (let row of rows) {
                row.cells[cell_index].classList.remove('highlight_cell');
            }

            row.classList.remove('highlight_cell');
            event.target.classList.remove('double_highlight');
        });
    });
});
