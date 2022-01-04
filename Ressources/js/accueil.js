

$(document).ready(function() { 
    $('nav.navbar').addClass("fixed-top");
    const areas = document.querySelectorAll('area');
    areas.forEach(item => {
        item.addEventListener("click", modal_sites, false);
    })
    
    function modal_sites(event){
        event.preventDefault();
        $('#'+ event.srcElement.alt).modal('toggle');
        return false;
    } 
})


$(window).resize(function () {
    $('#main').css('padding-top', parseInt($('nav.navbar').css("height")));
    window.header_height = $('nav.fixed-top').css("height");
   
    
  });
  
  $(window).ready(function () {
    $('#main').css('padding-top', parseInt($('nav.navbar').css("height")));
    window.header_height = $('nav.fixed-top').css("height");
  });