
/**
 * Добавление товара в корзину
 */
/**
 * Добавление товара в корзину
 */
function addToCart(itemId) {
    console.log("addToCart вызвана для " + itemId);

    var $button = $('#addCart_' + itemId);
    if ($button.length) {
        $button.text('Добавляем...').prop('disabled', true);
    }

    $.ajax({
        type: 'GET',
        url: '/cart/addtocart/' + itemId + '/',
        dataType: 'json',
        success: function(data) {
            console.log("Ответ сервера:", data);
            
            if (data.success) {
                // ===== ОБНОВЛЯЕМ ИНТЕРФЕЙС =====
                // 1. Счётчик корзины
                $('#cartCntItems').html(data.cartCntItems);
                
                // 2. Переключаем кнопки
                $('#addCart_' + itemId).hide();
                $('#removeCart_' + itemId).show();
                $('#removeCart_' + itemId).text('Удалить из корзины').prop('disabled', false);
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

/**
 * Удаление товара из корзины
 */
function removeFromCart(itemId) {
    console.log("removeFromCart вызвана для " + itemId);

    var $button = $('#removeCart_' + itemId);
    if ($button.length) {
        $button.text('Удаляем...').prop('disabled', true);
    }

    $.ajax({
        type: 'GET',
        url: '/cart/removefromcart/' + itemId + '/',
        dataType: 'json',
        success: function(data) {
            console.log("Ответ сервера:", data);

            if (data.success) {
                // ===== ОБНОВЛЯЕМ ИНТЕРФЕЙС =====
                // 1. Счётчик корзины
                $('#cartCntItems').html(data.cartCntItems);

                // 2. Переключаем кнопки
                $('#removeCart_' + itemId).hide();
                $('#addCart_' + itemId).show();
                $('#addCart_' + itemId).text('Добавить в корзину').prop('disabled', false);
            } else {
                alert('Ошибка: ' + data.message);
                if ($button.length) {
                    $button.text('Удалить из корзины').prop('disabled', false);
                }
            }
        },
        error: function() {
            alert('Ошибка соединения с сервером');
            if ($button.length) {
                $button.text('Удалить из корзины').prop('disabled', false);
            }
        }
    });
}

/**
 * Пересчёт цены при изменении количества
 */

function conversionPrice(itemId) {
    var newCnt = $('#itemCnt_' + itemId).val();
    var itemPrice = $('#itemPrice_' + itemId).attr('value');
    var itemRealPrice = newCnt * itemPrice;
    $('#itemRealPrice_' + itemId).html(itemRealPrice);
}

//Показать\скрыть блок регистрации

function showRegisterBox() {
    $('#registerBoxHidden').toggle();
}

//регистрация нового пользователя

function registerNewUser() {
    var email = $('#email').val();
    var pwd1 = $('#pwd1').val();
    var pwd2 = $('#pwd2').val();

    $.ajax({
        type: 'POST',
        url: '/user/register/',
        data: { email: email, pwd1: pwd1, pwd2: pwd2 },
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                alert('Вы успешно зарегистрированы!');
                location.reload();
            } else {
                alert('Ошибка: ' + data.message);
            }
        },
        error: function() {
            alert('Ошибка соединения с сервером');
        }
    });
}

