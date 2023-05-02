$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('.apply_coupon_btn').click(function(e) {
        e.preventDefault();

        var coupon_code =   $('.coupon_code').val();
        if($.trim(coupon_code).length == 0) {
            error_coupon = "Please enter valid Coupon";
            $('#error_coupon').text(error_coupon);
        }
        else
        {
            error_coupon = '';
            $('$error_coupon').text(error_coupon);
        }
        if(error_coupon != ''){
            return false;
        }

        $.ajax({
            method: 'POST',
            url: "/check-coupon-code",
            data: {
                'coupon_code': coupon_code
            },
            success: function (response){
                if(response.error_status == 'error')
                {
                    alertify.set('notifier','position','top-right');
                    alertify.success(response.status);
                    $('.coupon_code').val('');
                }
                else
                {
                    var discount_price = response.discount_price;
                    var grand_total_price = response.grand_total_price;
                    $('.coupon_code').prop('readonly',true);
                    $('.discount_price').text(discount_price);
                    $('.grandtotal_price').text(grand_total_price);
                }
            }
        });
    });


    $('.razorpay_pay_btn').click(function (e) {
        e.preventDefault();

        var data = {
            '_token': $('input[name=_token]').val(),
            'name': $('input[name=name]').val(),
            'lname': $('input[name=lname]').val(),
            'mobile': $('input[name=mobile]').val(),
            'address': $('input[name=address]').val(),
            'city': $('input[name=city]').val(),
            'state': $('input[name=state]').val(),
            'pincode': $('input[name=pincode]').val(),
        }

        $.ajax({
            type: 'POST',
            url: '/confirm-razorpay-payment',
            data: data,
            success: function (response) {
                if(response.status_code == 'no_data_in_cart')
                {
                    window.location.href = '/cart';
                }
                else
                {
                    // console.log(response.total_price);
                    // "amount": (response.total_price * 100),
                    var options = {
                        "key": "rzp_test_8ddxiie0uKtVvV",
                        // "amount": (response.grand_total_price * 100),
                        "amount": (1 * 100),
                        "name": "Master Furniture",
                        "description": "Thank you for purchasing",
                        "image": "https://example.com/your_logo",
                        "handler": function (razorpay_response){
                            $.ajax({
                                type: 'POST',
                                url: '/place-order',
                                data: {
                                    '_token': $('input[name=_token]').val(),
                                    'razorpay_payment_id': razorpay_response.razorpay_payment_id,
                                    'name': $('input[name=name]').val(),
                                    'lname': $('input[name=lname]').val(),
                                    'mobile': $('input[name=mobile]').val(),
                                    'address': $('input[name=address]').val(),
                                    'city': $('input[name=city]').val(),
                                    'state': $('input[name=state]').val(),
                                    'pincode': $('input[name=pincode]').val(),
                                    'place_order_razorpay': true,
                                },
                                success: function (msgsasa) {
                                    window.location.href = '/thank-you';
                                }
                            });

                            // alert(razorpay_response.razorpay_payment_id);
                        },
                        "prefill": {
                            "name": response.name + response.lname,
                            "contact": response.mobile,
                            "email": response.email,
                        },
                        "notes": {
                            "address": "Razorpay Corporate Office"
                        },
                        "theme": {
                            "color": "#3399cc"
                        }
                    };
                    var rzp1 = new Razorpay(options);
                        rzp1.open();
                        e.preventDefault();
                }
            }
        });
    });
});
