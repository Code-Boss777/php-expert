/**
 * Добавление товара в корзину
 * 
 * @param integer itemId ID продукта
 */
function addToCart(itemId) {
    console.log("js - addToCart() вызвана для товара " + itemId);
    
    var $button = $('#addCart_' + itemId);
    if ($button.length) {
        $button.text('Добавляем...').prop('disabled', true);
    }
    
    $.ajax({
        type: 'GET',
        url: '/cart/addtocart/' + itemId + '/',
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                $('#cartCntItems').html(data.cartCntItems);
                if ($button.length) {
                    $button.text('В корзине').removeClass('btn-primary').addClass('btn-success');
                }
            } else {
                alert('Ошибка: ' + data.message);
                if ($button.length) {
                    $button.text('Добавить в корзину').prop('disabled', false);
                }
            }
        },
        error: function() {
            alert('Ошибка соединения с сервером');
            if ($button.length) {
                $button.text('Добавить в корзину').prop('disabled', false);
            }
        }
    });
}