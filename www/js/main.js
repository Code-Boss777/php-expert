function addToCart(itemId) {
    console.log("js - addToCart() вызвана для товара " + itemId);
    
    // Блокируем кнопку
    var $button = $('#addCart_' + itemId);
    $button.text('Добавляем...').prop('disabled', true);
    
    $.ajax({
        type: 'POST',
        url: '/?controller=cart&action=addtocart',
        data: { id: itemId },
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                // Обновляем счётчик в шапке
                $('#cart-count').text(data.cartCount);
                
                // Меняем кнопку
                $button.text('В корзине').removeClass('btn-primary').addClass('btn-success');
                $('#removeCart_' + itemId).show();
            } else {
                alert('Ошибка: ' + data.message);
                $button.text('Добавить в корзину').prop('disabled', false);
            }
        },
        error: function() {
            alert('Ошибка соединения с сервером');
            $button.text('Добавить в корзину').prop('disabled', false);
        }
    });
}