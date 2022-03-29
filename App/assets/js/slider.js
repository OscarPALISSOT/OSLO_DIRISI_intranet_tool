let slider = document.getElementsByClassName('sliderRange')[0];
let sliderValue = document.getElementsByClassName('sliderValue')[0];

sliderValue.innerHTML = slider.value + ' €';

slider.oninput = function (){
    sliderValue.innerHTML = this.value + ' €';
}