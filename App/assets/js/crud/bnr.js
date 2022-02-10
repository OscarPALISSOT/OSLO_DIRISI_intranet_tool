//ajout d'un bnr via ajax et modal
$("#bnrFormCreate").submit(function AddBnr(e) {
    e.preventDefault()
    let form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data:form.serialize(),
        success: function(data, status)
        {
            let html = '<h2>BNR ajouté</h2>';
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
});

//suppression d'un bnr via ajax et modal
$("#bnrFormDelete").submit(function DeleteBnr(e) {
    e.preventDefault()
    let form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data:form.serialize(),
        success: function(data, status)
        {
            let html = '<h2>' + data.Bnr + '</h2>';
            $('.loading').html(null);
            $('#ajax-modalDelete').html(html);
        },
        error: function (xhr, ajaxOptions, thrownError)
        {
            $('.loading').html(null);
            $('#ajax-modalDelete').html('Error: ' + xhr.status);
            console.log(thrownError);
        }
    })
});

//modif d'un bnr via ajax et modal

let editForms = document.getElementsByClassName('bnrFormEdit');
for (let i = 0; i < editForms.length; i++){
    editForms[i].addEventListener('submit', function EditBnr(e) {
        e.preventDefault()
        let form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data:form.serialize(),
            success: function(data, status)
            {
                let html = '<h2> Modifications enregistrées </h2>';
                $('.loading').html(null);
                $('#ajax-modalEdit').html(html);

            },
            error: function (xhr, ajaxOptions, thrownError)
            {
                $('.loading').html(null);
                $('#ajax-modalEdit').html('Error: ' + xhr.status);
                console.log(thrownError);
            }
        })
    });
}