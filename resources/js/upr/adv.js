$(document).ready(function() {
    $('.price').click(function(){
        console.log('click');
        var indice_contatto = $(this).index();
        console.log(indice_contatto);
        $('.price.active').removeClass('active')
        $('.price').eq(indice_contatto).addClass('active');
    });
});
