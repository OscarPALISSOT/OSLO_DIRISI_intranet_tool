//ajout d'un quartiers via ajax et modal
$("#quartiersFormCreate").submit(function AddQuartiers(e) {
    e.preventDefault()
    let form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data:form.serialize(),
        success: function(data, status)
        {
            let html = '<h2>Nom du nouveau quartier : ' + data.Quartiers + '</h2>';
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

//suppression d'un quartiers via ajax et modal
$("#quartiersFormDelete").submit(function DeleteQuartiers(e) {
    e.preventDefault()
    let form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data:form.serialize(),
        success: function(data, status)
        {
            let html = '<h2>' + data.Quartiers + '</h2>';
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

//modif d'un quartiers via ajax et modal

let editForms = document.getElementsByClassName('quartiersFormEdit');
for (let i = 0; i < editForms.length; i++){
    editForms[i].addEventListener('submit', function Editquartiers(e) {
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