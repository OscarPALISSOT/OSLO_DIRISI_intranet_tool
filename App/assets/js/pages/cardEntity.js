

/**
 * @property {HTMLElement} cards
 */
export default class CardEntity{
    /**
     *
     * @param {HTMLElement|null} element
     */
    constructor(element) {
        if (element == null){
            return
        }
        this.cards = element.getElementsByClassName('Entity-card');
        this.bindEvents();
    }
    /**
     * Ajoute les comportements des éléments
     */
    bindEvents() {
        for (let i = 0; i < this.cards.length; i++){
            this.cards[i].querySelector('.collapseBtn').addEventListener('click', e =>{
                this.cards[i].querySelector('.card-content').classList.toggle("active")
            })
        }
    }
}





