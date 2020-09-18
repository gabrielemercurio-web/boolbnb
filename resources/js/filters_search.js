$(document).ready(function () {
   
    $('.btn-filters').click(function(){

        $('.bg-filters-form').addClass('active');
        $('form.form').addClass('active');
        
    });

    $('.search-update-btn').click(function(){

        $('.bg-filters-form').removeClass('active');
        $('form.form').removeClass('active');
    });
   
    $('.bg-filters-form').click(function(){

        $('.bg-filters-form').removeClass('active');
        $('form.form').removeClass('active');
    });

    $("form.form").validate({
        rules: {
            services: {
                min: 1
            }
        },
        messages: {
            services: {
                min: "Value must be greater than 0."
            }
        }
    });

});