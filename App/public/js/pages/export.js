
  
$(document).ready(function () {

    $('button').remove();
    $('.modal').remove();
    // $('span.text').remove();
    $('td.noborders').remove();
    var opt = {
        filename: "export.pdf",
        margin: 5,
        pagebreak: {
            mode: ['avoid-all', 'css', 'legacy'],
            after: [".pagebreak"]
        }
        };

        html2pdf(document.body, opt)

});