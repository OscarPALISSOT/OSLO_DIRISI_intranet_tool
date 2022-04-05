


/**
 * @property {HTMLElement} select
 * @property {HTMLFormElement} form
 * @property {HTMLElement} filters
 */

export default class ShowFilter{

    /**
     *
     * @param {HTMLElement|null} element
     */
    constructor(element) {
        if (element == null){
            return
        }
        this.form = element.getElementsByClassName('filter');
        this.select = element.getElementsByClassName('selectFilter')[0]
        this.filters = element.getElementsByClassName('inputFilter')
        this.feedSelect()
        this.showInput(this.filters)
    }

    /**
     * feed the multiselect with the inputs title
     */
    feedSelect(){
        for (const item of this.filters){
            let option = document.createElement("option");
            option.innerHTML = item.firstElementChild.innerHTML;
            this.select.appendChild(option)
        }
    }

    /**
     * show or hide the input
     */
     showInput(filters){
        let observer = new MutationObserver(function (e) {
            if (e[0].removedNodes){
                for (const item of filters){
                    console.log('test')
                    item.style.display = 'none';
                }
            }
        });
        this.select.oninput = function (){
            let chosen = document.getElementsByClassName('search-choice')
            for (const item of chosen){
                let input = document.getElementById(item.firstElementChild.innerHTML)
                input.style.display = 'block';
            }

        }
    }


}