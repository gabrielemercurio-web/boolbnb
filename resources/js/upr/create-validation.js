$(document).ready(function(){

    $("#form-create").validate({
        rules: {
            title: {
                required: true,
                rangelength: [1, 250]
            },
            description: {
                maxlength: 2000
            },
            address: {
                required: true
            },
            cover_image: {
                extension: "png|jpg|jpeg"
            },
            nr_of_rooms: {
                required: true,
                number: true,
                min: 0
            },
            nr_of_beds: {
                required: true,
                number: true,
                min: 0
            },
            nr_of_bathrooms: {
                number: true,
                min: 0
            },
            square_mt: {
                number: true,
                min: 1
            }
        },
        messages: {
            title: {
                required: "Please, specify a title.",
                rangelength: "Min 1, max 250 characters."
            },
            description: {
                maxlength: "Max 2000 characters."
            },
            address: {
                required: "Address required."
            },
            cover_image: {
                extension: "Only .png, .jpg and .jpeg files allowed."
            },
            nr_of_rooms: {
                required: "Number of rooms required."
            },
            nr_of_beds: {
                required: "Number of beds required."
            },
            nr_of_bathrooms: {
                number: "Only positive numbers."
            },
            square_mt: {
                number: "Only numbers greater than one."
            }
        }
    });

    $('#btnUpload').click(function(event) {
        
        if( $('#form-create').find('input[required]').val() == "" ) {
            
            alert('prova');

            // event.preventDefault();
            // setTimeout(function() {
            //         $('#form-create').submit()
            //     }, 1500);

            // if(event.isDefaultPrevented()) {
            //     $('#form-create .required').addClass('validate-error');
            // } 
        } 
    });

});
