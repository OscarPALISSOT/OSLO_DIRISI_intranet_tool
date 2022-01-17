//ajout d'un rfz via ajax et modal
$("#rfzFormCreate").submit(function Addrfz(e) {
    e.preventDefault()
    var form = $(this);
    var actionUrl = form.attr('action');
    $.ajax({
        url: actionUrl,
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