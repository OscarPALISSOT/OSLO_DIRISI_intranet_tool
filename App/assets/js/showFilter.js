


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
        this.showInput()
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
    showInput(){
        this.select.oninput = function (){
            let selectedInput = document.getElementsByClassName('chosen-choices')[0].children
            let filters = this.filters
            debugger
            for (const item of selectedInput){
                let input = filters.getElementById(item.firstElementChild.innerHTML)
                input.style.backgroundColor = 'black'

            }
        }

    }


}