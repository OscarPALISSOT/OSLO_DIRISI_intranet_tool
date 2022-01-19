


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
            $('#ajax-modal').html(html);
        },
        error: function (xhr, ajaxOptions, thrownError)
        {
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
            $('#ajax-modalDelete').html(html);
        },
        error: function (xhr, ajaxOptions, thrownError)
        {
            $('#ajax-modalDelete').html('Error: ' + xhr.status);
            console.log(thrownError);
        }
    })
});

//modif d'un rfz via ajax et modal
$("#rfzFormCheck").submit(function Editrfz(e) {
    e.preventDefault()
    let form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data:form.serialize(),
        success: function(data, status)
        {
            if (data.action === 'edit'){
                let html = '<h2>Nouveau nom du routeur : ' + data.Rfz + '</h2>';
                $('#ajax-modalEdit').html(html);
            }
            else {
                let html = '<h2>' + data.Rfz + '</h2>';
                $('#ajax-modalDelete').html(html);
            }

        },
        error: function (xhr, ajaxOptions, thrownError)
        {
            $('#ajax-modalEdit').html('Error: ' + xhr.status);
            console.log(thrownError);
        }
    })
});