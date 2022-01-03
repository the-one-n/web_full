function addToCart(e) {
    const $e = $(e);

        $.ajax({
            url: 'index.php?route=checkout/cart/add',
            type: 'post',
            data: $e.siblings('input[type=\'text\'], input[type=\'hidden\'], input[type=\'radio\']:checked, input[type=\'checkbox\']:checked, select, textarea'),
            dataType: 'json',
            beforeSend: function() {
                $e.button('loading');
            },
            complete: function() {
                $e.button('reset');
            },
            success: function(json) {
                $('.alert-dismissible, .text-danger').remove();
                $('.form-group').removeClass('has-error');

                let count = json.total.match(/(\d+)/)[0];

                $('.cart-count').text(count);

                if (json['error']) {
                    if (json['error']['option']) {
                        for (i in json['error']['option']) {
                            var element = $('#input-option' + i.replace('_', '-'));

                            if (element.parent().hasClass('input-group')) {
                                element.parent().after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                            } else {
                                element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                            }
                        }
                    }

                    if (json['error']['recurring']) {
                        $('select[name=\'recurring_id\']').after('<div class="text-danger">' + json['error']['recurring'] + '</div>');
                    }

                    // Highlight any found errors
                    $('.text-danger').parent().addClass('has-error');
                }

                if (json['success']) {
                    $('.breadcrumb').after('<div class="alert alert-success alert-dismissible">' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                    $('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');

                    $('html, body').animate({ scrollTop: 0 }, 'slow');

                    $('#cart > ul').load('index.php?route=common/cart/info ul li');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
}

function addToCartWithSelectedQuantity(e) {
    const $e = $(e);
    const $counter = $e.siblings('.product-menu-item__count ');
    $counter.css("display", "block");
    $counter.val($counter.data('loading-text'));
    $e.siblings('.product-menu-item__count-submit').css("display", "block");
    $e.css("display", "none");
}