
let sideNav = document.getElementById('sideNav');
let main = document.getElementById('main');

const resizeObserver = new ResizeObserver(entries =>
    sideNav.style.height = main.offsetHeight + "px"
)
resizeObserver.observe(main)



var navItem = document.querySelectorAll('.sideNavItem');

function activeSideNavitem(){

    navItem.forEach( function (item){
        item.classList.remove('active')
        if ( item.firstElementChild.href === window.location.href) {
            item.classList.add('active')
        }
    })
}

window.onload = function (){
    activeSideNavitem()
}