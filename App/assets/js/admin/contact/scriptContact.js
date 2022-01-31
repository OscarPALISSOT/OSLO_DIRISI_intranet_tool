//ajout d'un contact via ajax et modal
$("#contactFormCreate").submit(function AddContact(e) {
    alert('test')
    e.preventDefault()
    let form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data:form.serialize(),
        success: function(data, status)
        {
            let html = '<h2>Nouveau contact : ' + data.Contact + '</h2>';
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

//suppression d'un contact via ajax et modal
$("#contactFormDelete").submit(function DeleteContact(e) {
    e.preventDefault()
    let form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data:form.serialize(),
        success: function(data, status)
        {
            let html = '<h2>' + data.Contact + '</h2>';
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

//modif d'un contact via ajax et modal

let editForms = document.getElementsByClassName('contactFormEdit');
for (let i = 0; i < editForms.length; i++){
    editForms[i].addEventListener('submit', function Editcontact(e) {
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