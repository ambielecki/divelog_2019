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
});
