//ajout d'un rfz via ajax et modal
$("#submit").click(function Addrfz() {
    $.ajax({
        url: "/Admin/NouveauAdmins",
        type: "POST",
        data:{
            username: $('#username').val(),
            _token: $('#_token').val()
        },
        async:      true,
        success: function(data, status)
        {
            var html = '<h2>Identifiant : ' + data.login + '</h2>';

            $('#ajax-modal').html(html);
        },
        error: function (xhr, ajaxOptions, thrownError)
        {
            $('#ajax-modal').html('Error: ' + xhr.status);
            console.log(thrownError);
        }
    });
});