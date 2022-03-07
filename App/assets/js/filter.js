import {Flipper, spring} from "flip-toolkit";
import {indexOf} from "core-js/internals/array-includes";


/**
 * @property {HTMLElement} pagination
 * @property {HTMLElement} content
 * @property {HTMLElement} sorting
 * @property {HTMLElement} reset
 * @property {HTMLFormElement} form
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
        this.reset = element.querySelector('.js-filter-reset')
        this.bindEvents()
    }


    /**
     * Ajoute les comportements des éléments
     */
    bindEvents() {
        const LinkClickListener = e => {
            if (e.target.tagName === 'A'){
                e.preventDefault()
                this.loadUrl(e.target.getAttribute('href'))
            }
        }
        this.sorting.addEventListener('click', LinkClickListener)
        this.pagination.addEventListener('click', LinkClickListener)
        this.form.addEventListener('submit', e => {
            e.preventDefault()
            this.loadForm(this)
        })
        this.reset.addEventListener( 'click', e => {
            e.preventDefault()
            let url = location.protocol + '//' + location.host + location.pathname + '?&Ajax=1';
            this.loadUrl(url)
        })
    }

    async loadForm(){
        const data = new FormData(this.form)
        const url = new  URL(this.form.getAttribute('action') || window.location.href)
        const params = new URLSearchParams()
        data.forEach((value, key) => {
            params.append(key, value)
        })
        return this.loadUrl(url.pathname + '?' + params.toString())
    }

    async loadUrl(url) {
        const ajaxUrl = url + '&Ajax=1'
        const response = await fetch(ajaxUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        if (response.status >= 200 && response.status < 300){
            const data = await response.json()
            this.flipContent(data.content)
            this.sorting.innerHTML = data.sorting
            this.pagination.innerHTML = data.pagination
            history.replaceState({}, '', url)
        }
        else {
            console.error(response)
        }
    }


    /**
     * anime les grilles de content avec un effet flip
     * @param {string} content
     */
    flipContent(content){
        const springConfig = 'veryGentle';
        const exitSpring  = function (element, index,  onComplete) {
            spring({
                config: 'stiff',
                values: {
                    translateY: [0, -20],
                    opacity: [1, 0]
                },
                onUpdate: ({ translateY, opacity }) => {
                    element.style.opacity = opacity;
                    element.style.transform = `translateY(${translateY}px)`;
                },
                onComplete
            });
        }
        const flipper = new Flipper({
            element: this.content
        })
        for (const element of this.content.children) {
            flipper.addFlipped({
                element,
                spring: springConfig,
                flipId: element.id,
                shouldFlip: false,
                onExit: exitSpring

            })
        }
        flipper.recordBeforeUpdate()
        this.content.innerHTML = content
        for (const element of this.content.children) {
            flipper.addFlipped({
                element,
                spring: springConfig,
                flipId: element.id
            })
        }
        flipper.update()
    }


}