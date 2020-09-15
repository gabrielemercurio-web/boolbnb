$(document).ready(function(){

    $("#form-create").validate({

        rules: {
            title: {
                required: true,
            },
            description: {
                required: true,
            },
            address: {
                required: true,
            },
            cover_image: {
                required: true,
            },
            nr_of_rooms: {
                required: true,
            },
            nr_of_beds: {
                required: true,
            },
            nr_of_bathrooms: {
                required: true,
            },
            square_mt: {
                required: true,
            },
        },
        messages: {
            title: "Please, specify a title",
            description: {
                required: "Description needs. Min 50, max 5000 characters.",
            }
        }

    });

});
