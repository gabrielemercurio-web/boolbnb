$(document).ready(function() {
    $('.price').click(function(){
        var indice_contatto = $(this).index();
        $('.price.active').removeClass('active')
        $('.price').eq(indice_contatto).addClass('active');
    });
});
