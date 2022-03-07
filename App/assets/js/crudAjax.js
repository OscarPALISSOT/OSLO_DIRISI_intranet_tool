/**
 * @property {HTMLFormElement} form
 */

export default class CrudAjax{

    /**
     *
     * @param {HTMLElement|null} element
     */
    constructor(element) {
        if (element == null){
            return
        }
        this.form = element.getElementsByClassName('js-Ajax-form')
        this.bindEvents()
        debugger
    }


    /**
     * Ajoute les comportements des éléments
     */
    bindEvents() {
        for (let i = 0; i < this.form.length; i++){
            this.form[i].addEventListener( 'submit', e => {
                e.preventDefault()
                let formSubmited = $(this.form[i]);
                this.AjaxUrl(formSubmited)
            })
        }
    }


    AjaxUrl(form) {
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data:form.serialize(),
            success: function(data, status)
            {
                let html = '<h2>' + data.message + '</h2>';
                $('.loading').html(null);
                $('#ajax-modal').html(html);
            },
            error: function (xhr, ajaxOptions, thrownError)
            {
                $('.loading').html(null);
                $('#ajax-modal').html('Error: ' + xhr.status);
                console.log(thrownError);
            }
        })
    }
}