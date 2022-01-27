
let sideNav = document.getElementById('sideNav');
let main = document.getElementById('main');

const resizeObserver = new ResizeObserver(entries =>
    sideNav.style.height = main.offsetHeight + "px"
)
resizeObserver.observe(main)