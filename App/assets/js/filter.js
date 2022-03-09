import {Flipper, spring} from "flip-toolkit";

/**
 * @property {HTMLElement} pagination
 * @property {HTMLElement} content
 * @property {HTMLElement} sorting
 * @property {HTMLElement} reset
 * @property {HTMLElement} modalReset
 * @property {HTMLElement} secondModal
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
        this.modalReset = element.querySelector('.js-modal-reset')
        this.secondModal = element.querySelector('.js-secondModal')
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
            let url = location.protocol + '//' + location.host + location.pathname;
            this.form.reset()
            this.loadUrl(url)

        })
        if (this.modalReset){
            this.modalReset.addEventListener( 'click', e => {
                e.preventDefault()
                let url = location.protocol + '//' + location.host + location.pathname;
                this.form.reset()
                this.loadUrl(url)

            })
        }

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
        this.showLoader()
        const params = new URLSearchParams(url.split('?')[1] || '')
        params.set('Ajax', 1)
        const response = await fetch(url.split('?')[0] + '?' + params.toString(), {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        if (response.status >= 200 && response.status < 300){
            const data = await response.json()
            this.flipContent(data.content)
            this.sorting.innerHTML = data.sorting
            this.pagination.innerHTML = data.pagination
            this.secondModal.innerHTML = data.secondModal
            params.delete('Ajax')
            history.replaceState({}, '', url.split('?')[0] + '?' + params.toString())
        }
        else {
            console.error(response)
        }
        /*$(".app-script script").each(function(){
            var oldScript = this.getAttribute("src");
            $(this).remove();
            var newScript;
            newScript = document.createElement('script');
            newScript.type = 'text/javascript';
            newScript.src = oldScript;
            document.getElementsByClassName("app-script")[0].appendChild(newScript);
        });*/
        this.hideLoader()
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
        const appearSpring  = function (element, index) {
            spring({
                config: 'stiff',
                values: {
                    translateY: [20, 0],
                    opacity: [0, 1]
                },
                onUpdate: ({ translateY, opacity }) => {
                    element.style.opacity = opacity;
                    element.style.transform = `translateY(${translateY}px)`;
                },
                delay: index * 20
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
                flipId: element.id,
                onAppear: appearSpring
            })
        }
        flipper.update()
    }

    showLoader(){
        this.form.classList.add('is-loading')
        const spinner = this.form.querySelector('.js-loading')
        if (spinner === null){
            return
        }
        spinner.style.display = null;
    }

    hideLoader(){
        this.form.classList.remove('is-loading')
        const spinner = this.form.querySelector('.js-loading')
        if (spinner === null){
            return
        }
        spinner.style.display = 'none';
    }


}