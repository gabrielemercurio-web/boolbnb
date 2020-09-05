$(document).ready(function() {
    $('.message').click(function(){
        var indice_contatto = $(this).index();
        $('.description.active').removeClass('active');
        $('.description').eq(indice_contatto).addClass('active');
        $('.message.visible').removeClass('visible');
        $('.message').eq(indice_contatto).addClass('visible');
    });
});
