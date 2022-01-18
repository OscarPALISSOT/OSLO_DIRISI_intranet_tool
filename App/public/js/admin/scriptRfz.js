//ajout d'un rfz via ajax et modal
$("#rfzFormCreate").submit(function Addrfz(e) {
    e.preventDefault()
    var form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data:form.serialize(),
        success: function(data, status)
        {
            var html = '<h2>Nom du nouveau routeur : ' + data.Rfz + '</h2>';
            $('#ajax-modal').html(html);
        },
        error: function (xhr, ajaxOptions, thrownError)
        {
            $('#ajax-modal').html('Error: ' + xhr.status);
            console.log(thrownError);
        }
    })
});


//modif d'un rfz via ajax et modal
$("#rfzFormEdit").submit(function Editrfz(e) {
    e.preventDefault()
    var form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data:form.serialize(),
        success: function(data, status)
        {
            var html = '<h2>Nouveau nom du routeur : ' + data.Rfz + '</h2>';
            $('#ajax-modalEdit').html(html);
        },
        error: function (xhr, ajaxOptions, thrownError)
        {
            $('#ajax-modalEdit').html('Error: ' + xhr.status);
            console.log(thrownError);
        }
    })
});