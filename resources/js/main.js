document.addEventListener('DOMContentLoaded', function() {
    DiveLogRepeat.initSidenav();
    DiveLogRepeat.initDropdown();
    DiveLogRepeat.initCollapsible();
    DiveLogRepeat.initCarousel({
        fullWidth: true,
        indicators: true
    });
    DiveLogRepeat.initTableCrosshair();
    DiveLogRepeat.initFlashMessage();
});

window.DiveLogRepeat = {
    // Credit David Walsh (https://davidwalsh.name/javascript-debounce-function)

    // Returns a function, that, as long as it continues to be invoked, will not
    // be triggered. The function will be called after it stops being called for
    // N milliseconds. If `immediate` is passed, trigger the function on the
    // leading edge, instead of the trailing.
    debounce: (func, wait, immediate = false) => {
        let timeout;

        return function executedFunction() {
            let context = this;
            let args = arguments;

            let later = function() {
                timeout = null;
                if (!immediate) {
                    func.apply(context, args);
                }
            };

            let callNow = immediate && !timeout;

            clearTimeout(timeout);

            timeout = setTimeout(later, wait);

            if (callNow) {
                func.apply(context, args);
            }
        };
    },

    initTableCrosshair: () => {
        let crosshair_tables = document.querySelectorAll('.crosshair_table');

        crosshair_tables.forEach(function (crosshair_table) {
            let cells = crosshair_table.querySelectorAll('td, th');
            let ignore_header = crosshair_table.classList.contains('crosshair_ignore_header')
                || crosshair_table.classList.contains('crosshair_ignore_first');

            let ignore_column = crosshair_table.classList.contains('crosshair_ignore_column')
                || crosshair_table.classList.contains('crosshair_ignore_first');

            cells.forEach(function (cell) {
                cell.addEventListener('mouseover', function (event) {
                    let target = event.target;
                    let cell_index = target.cellIndex;
                    let target_row = target.closest('tr');
                    let row_index = target_row.rowIndex;
                    let rows = target.closest('table').rows;

                    if (cell_index !== 0 && ignore_column) {
                        for (let row of rows) {
                            row.cells[cell_index].classList.add('highlight_cell');
                        }
                    }

                    if (row_index !== 0 && ignore_header) {
                        target_row.classList.add('highlight_cell');
                    }

                    if (!(cell_index === 0 && ignore_column) && !(row_index === 0 && ignore_header)) {
                        target.classList.add('double_highlight');
                    }
                });

                cell.addEventListener('mouseout', function (event) {
                    let target = event.target;
                    let cell_index = target.cellIndex;

                    let row = target.closest('tr');
                    let rows = target.closest('table').rows;

                    for (let row of rows) {
                        row.cells[cell_index].classList.remove('highlight_cell');
                    }

                    row.classList.remove('highlight_cell');
                    target.classList.remove('double_highlight');
                });
            });
        });
    },

    initSidenav: (options = {}) => {
        let nav = document.querySelectorAll('.sidenav');
        Materialize.Sidenav.init(nav, options);
    },

    initDropdown: (options = {}) => {
        let dropdowns = document.querySelectorAll('.dropdown-trigger');
        Materialize.Dropdown.init(dropdowns, options);
    },

    initCollapsible: (options = {}) => {
        let collapsible = document.querySelectorAll('.collapsible');
        Materialize.Collapsible.init(collapsible, options);
    },

    initCarousel: (options = {}) => {
        let carousel = document.querySelectorAll('.carousel');
        Materialize.Carousel.init(carousel, options);
    },

    initFlashMessage: () => {
        document.querySelectorAll('.flash_close').forEach(function (element) {
            element.addEventListener('click', function (event) {
                let parent = event.target.closest('.flash');
                parent.style.display = 'none';
            });
        });
    }
};
