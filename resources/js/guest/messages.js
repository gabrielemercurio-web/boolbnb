$(document).ready(function() {
    $('.message').click(function(){
    console.log('click');
    var indice_contatto = $(this).index();
    console.log(indice_contatto);
    $('.description.active').removeClass('active')
    $('.description').eq(indice_contatto).addClass('active');
    $('.message.visible').removeClass('visible')
    $('.message').eq(indice_contatto).addClass('visible')
    });
});
