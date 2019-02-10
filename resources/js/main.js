document.addEventListener('DOMContentLoaded', function() {
    let nav = document.querySelectorAll('.sidenav');
    materialize.Sidenav.init(nav, {});

    let dropdowns = document.querySelectorAll('.dropdown-trigger');
    materialize.Dropdown.init(dropdowns, {});
});