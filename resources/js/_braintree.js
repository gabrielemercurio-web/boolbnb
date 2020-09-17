var form = document.querySelector('#payment-form');
braintree.dropin.create({
    // Insert your tokenization key here
    authorization: 'sandbox_w3dfnx46_6hqm567rbwp58h5h',
    container: '#dropin-container'
}, function (createErr, instance) {
    if (createErr) {
        console.log('Create Error', createErr);
        return;
    }
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        instance.requestPaymentMethod(function (err, payload) {
            if (err) {
                console.log('Request Payment Method Error', err);
                return;
            }

            $('#nonce').val(payload.nonce);

            form.submit();       
        });
    });
});

$('.advert-type').on('click', function(e) {
    var adv_amount = $(e.target).val();
    $('#payment-amount').val(adv_amount);
})