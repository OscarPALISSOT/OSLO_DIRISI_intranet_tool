

let cards = document.getElementsByClassName('Entity-card');


for (let i = 0; i < cards.length; i++){
    cards[i].querySelector('.collapseBtn').addEventListener('click', e =>{
        cards[i].querySelector('.card-content').classList.toggle("active")
    })
}