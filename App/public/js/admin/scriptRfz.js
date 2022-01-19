


//ajout d'un rfz via ajax et modal
$("#rfzFormCreate").submit(function AddRfz(e) {
    e.preventDefault()
    let form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data:form.serialize(),
        success: function(data, status)
        {
            let html = '<h2>Nom du nouveau routeur : ' + data.Rfz + '</h2>';
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

//suppression d'un rfz via ajax et modal
$("#rfzFormDelete").submit(function DeleteRfz(e) {
    e.preventDefault()
    let form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data:form.serialize(),
        success: function(data, status)
        {
            let html = '<h2>' + data.Rfz + '</h2>';
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

//modif d'un rfz via ajax et modal

let editForms = document.getElementsByClassName('rfzFormEdit');
for (let i = 0; i < editForms.length; i++){
    editForms[i].addEventListener('submit', function Editrfz(e) {
        e.preventDefault()
        let form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data:form.serialize(),
            success: function(data, status)
            {
                let html = '<h2>Nouveau nom du routeur : ' + data.Rfz + '</h2>';
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