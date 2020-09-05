$(document).ready(function() {

    $('nav .nav-button-menu').click(function(){

        // $('nav div').toggleClass('modal-menu');

        if ($('nav div').hasClass('modal-menu')) {
            $('nav div').removeClass('modal-menu');
        } else {
            $('nav div').addClass('modal-menu');
        }
    });

});
