document.addEventListener('DOMContentLoaded', function() {
    let nav = document.querySelectorAll('.sidenav');
    materialize.Sidenav.init(nav, {});

    let dropdowns = document.querySelectorAll('.dropdown-trigger');
    materialize.Dropdown.init(dropdowns, {});

    let mobile_nav = document.querySelectorAll('.sidenav');
    materialize.Sidenav.init(mobile_nav, {});

    let collapsible = document.querySelectorAll('.collapsible');
    materialize.Collapsible.init(collapsible, {});

    let carousel = document.querySelectorAll('.carousel');
    materialize.Carousel.init(carousel, {
        fullWidth: true,
        indicators: true
    });

    DiveLogRepeat.initHighlightCells();
});

DiveLogRepeat = {
    initHighlightCells: () => {
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
    },
};
