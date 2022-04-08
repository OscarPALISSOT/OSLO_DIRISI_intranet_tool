let map = document.querySelector('#map');
let paths = map.querySelectorAll('.map__image a')
let links = document.querySelectorAll('.map__list a')


//polyfill pour le foreach sur les nodelist
if (NodeList.prototype.forEach === undefined){
    NodeList.prototype.forEach = function (callback){
        [].forEach.call(this, callback)
    }
}

let Active = function (id){
    document.querySelectorAll('.link-active').forEach( function (item){
        item.classList.remove('link-active')
    })
    if (id !== undefined){
        document.querySelector('#list-' + id).classList.add('link-active')
        document.querySelector('#circle-' + id).classList.add('link-active')
    }
}


paths.forEach(function (path){
    path.addEventListener('mouseenter', function (){
        let id = this.id.replace('circle-', '')
        Active(id);
    })
})

links.forEach(function (link){
    link.addEventListener('mouseenter', function (){
        let id = this.id.replace('list-', '')
        Active(id)
    })
})

map.addEventListener('mouseover', function (){
    Active();
})

document.querySelector('.basesDefenses').addEventListener('mouseover', function (){
    Active();
})
