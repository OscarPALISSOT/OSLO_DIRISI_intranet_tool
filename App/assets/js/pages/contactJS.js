let toogle = document.getElementsByClassName('toogleContact');

for (let i = 0; i < toogle.length; i++){
    debugger
    toogle[i].addEventListener('click', function (){
        this.classList.toggle('activeToogle')
    });
}