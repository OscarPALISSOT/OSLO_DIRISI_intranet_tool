/**
 * @property {HTMLElement} pagination
 * @property {HTMLElement} content
 * @property {HTMLElement} sorting
 * @property {HTMLElement} form
 */

export default class Filter{

    /**
     *
     * @param {HTMLElement|null} element
     */
    constructor(element) {
        if (element == null){
            return
        }
        this.pagination = element.querySelector('.js-filter-pagination')
        this.content = element.querySelector('.js-filter-content')
        this.sorting = element.querySelector('.js-filter-sorting')
        this.form = element.querySelector('.js-filter-form')
        this.bindEvents()
    }


    /**
     * Ajoute les comportements des éléments
     */
    bindEvents() {
        let sortingLinks = this.sorting.getElementsByTagName('a');
        for (let i = 0; i < sortingLinks.length; i++){
            sortingLinks[i].addEventListener( 'click', e => {
                //e.preventDefault()
                this.loadUrl(sortingLinks[i].getAttribute('href'))
            })
        }
    }

    async loadUrl(url) {
        const response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        if (response.status >= 200 && response.status > 300){
            const data = await response.Json()
            this.content.innerHTML = data.content
        }
        else {
            console.error(response)
        }
    }


}