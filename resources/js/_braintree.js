braintree.dropin.create({
    // Insert your tokenization key here
    authorization: 'sandbox_w3dfnx46_6hqm567rbwp58h5h',
    container: '#dropin-container'
}, function (createErr, instance) {
    $('#payment-submit').on('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
            let amount = $("input[name='payment_amount']").val();
            $.ajax({
                type: 'GET',
                url: 'http://localhost:8000/upr/payments/checkout',
                data: {payload, amount: amount},
                success: function(response) {
                    if (response.success) {
                        alert('Payment successfull!');
                    } else {
                        alert('Payment failed');
                    }
                },
                dataType: 'json'
              });
        });
    });
});

$('.advert-type').on('click', function(e) {
    var adv_amount = $(e.target).val();
    $('#payment-amount').val(adv_amount);
})