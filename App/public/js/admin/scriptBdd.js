//ajout d'un bdd via ajax et modal
$("#bddFormCreate").submit(function AddBdd(e) {
    e.preventDefault()
    let form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data:form.serialize(),
        success: function(data, status)
        {
            let html = '<h2>Nom de la nouvelle base : ' + data.Bdd + '</h2>';
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

//suppression d'un bdd via ajax et modal
$("#bddFormDelete").submit(function DeleteBdd(e) {
    e.preventDefault()
    let form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data:form.serialize(),
        success: function(data, status)
        {
            let html = '<h2>' + data.Bdd + '</h2>';
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

//modif d'un bdd via ajax et modal

let editForms = document.getElementsByClassName('bddFormEdit');
for (let i = 0; i < editForms.length; i++){
    editForms[i].addEventListener('submit', function Editbdd(e) {
        e.preventDefault()
        let form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data:form.serialize(),
            success: function(data, status)
            {
                let html = '<h2>Nouveau nom de la base : ' + data.Bdd + '</h2>';
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