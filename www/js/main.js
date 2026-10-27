
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
            if (data.success) {
                // Если мы на странице корзины, перезагружаем её
                if (window.location.pathname === '/cart/' || window.location.href.includes('/cart')) {
                    location.reload();
                } else {
                    // Если на странице товара — переключаем кнопки
                    $('#cartCntItems').html(data.cartCntItems);
                    $('#removeCart_' + itemId).hide();
                    $('#addCart_' + itemId).show();
                }
            } else {
                alert('Ошибка: ' + data.message);
            }
        }, // <--- ЗДЕСЬ ДОЛЖНА БЫТЬ ЗАПЯТАЯ, А НЕ '}},'
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
    // 1. Получаем новое количество из поля
    var newCnt = $('#itemCnt_' + itemId).val();
    var itemPrice = $('#itemPrice_' + itemId).attr('value');
    
    // 2. Пересчитываем сумму для этой позиции
    var itemRealPrice = newCnt * itemPrice;
    $('#itemRealPrice_' + itemId).html(itemRealPrice);

    // === 3. ВЫЗЫВАЕМ ПЕРЕСЧЕТ ОБЩЕЙ СУММЫ ===
    calculateTotal(); 

    // 4. Отправляем данные на сервер (AJAX)
    $.ajax({
        type: 'POST',
        url: '/cart/updatecount/',
        data: { id: itemId, count: newCnt },
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                console.log('Количество сохранено в сессии');
            } else {
                alert('Ошибка сохранения: ' + data.message);
            }
        }
    });
}


//Показать\скрыть блок регистрации

function showRegisterBox() {
    $('#registerBoxHidden').toggle();
}

//регистрация нового пользователя

/**
 * Получить данные из формы регистрации
 */
function getData() {
    return {
        email: $('#email').val(),
        pwd1: $('#pwd1').val(),
        pwd2: $('#pwd2').val(),
        name: $('#name').val(),
        phone: $('#phone').val(),
        address: $('#address').val()
    };
}

/**
 * Регистрация нового пользователя
 */
function registerNewUser() {
    var postData = getData();
    
    $.ajax({
        type: 'POST',
        url: '/user/register/',
        data: postData,
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                alert('Регистрация прошла успешно!');
                
                // Скрываем формы
                $('#registerBox').hide();
                $('#loginBox').hide();

                // Показываем блок пользователя
                $('#userLink').attr('href', '/user/');
                $('#userLink').html(data.userName || 'Пользователь');
                $('#userBox').show();
            } else {
                alert(data.message);
            }
        },
        error: function() {
            alert('Ошибка соединения с сервером');
        }
    });
}

/**
 * Выход пользователя
 */
function logout() {
    $.ajax({
        type: 'GET',
        url: '/user/logout/',
        dataType: 'json',
        success: function() {
            location.reload(); //Перезагружаем страницу, чтобы обновить меню
        },
        error: function() {
            location.reload();
        }
    });
}
/**
 * Показать/скрыть блок авторизации
 */
function showLoginBox() {
    $('#loginBoxHidden').toggle();
}

/**
 * Авторизация пользователя
 */
function login() {
    var email = $('#loginEmail').val();
    var pwd = $('#loginPwd').val();
    
    $.ajax({
        type: 'POST',
        url: '/user/login/',
        data: { email: email, pwd: pwd },
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                alert('Вы успешно вошли!');
                
                // Скрываем блоки регистрации и авторизации
                $('#registerBox').hide();
                $('#loginBox').hide();
                
                // Показываем блок пользователя
                $('#userLink').html(data.userName);
                $('#userBox').show();
            } else {
                alert('Ошибка: ' + data.message);
            }
        },
        error: function() {
            alert('Ошибка соединения с сервером');
        }
    });
}
/**
 * Пересчитать общую сумму всей корзины
 */
function calculateTotal() {
    var total = 0;
    // Проходим по всем ячейкам с итоговой ценой позиции
    $('[id^="itemRealPrice_"]').each(function() {
        var price = parseFloat($(this).text()) || 0;
        total += price;
    });
    // Выводим общую сумму
    $('#totalPrice').html(total);
}

// Вызываем подсчет при загрузке страницы корзины
$(document).ready(function() {
    if ($('#totalPrice').length > 0) {
        calculateTotal();
    }
});

/**
 * Отправка данных для обновления профиля
 */
function updateUserData() {
    var postData = {
        name:    $('#newName').val(),
        phone:   $('#newPhone').val(),
        address: $('#newAdress').val(), // Обрати внимание: в твоем tpl написано newAdress
        pwd1:    $('#newPwd1').val(),
        pwd2:    $('#newPwd2').val(),
        curPwd:  $('#curPwd').val()
    };

    $.ajax({
        type: 'POST',
        url: '/user/update/',
        data: postData,
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                alert(data.message);
                // Обновляем имя в левом меню (если оно изменилось)
                $('#userLink').html(data.userName);
                
                // Очищаем поля с паролями
                $('#newPwd1').val('');
                $('#newPwd2').val('');
                $('#curPwd').val('');
            } else {
                alert('Ошибка: ' + data.message);
            }
        },
        error: function() {
            alert('Ошибка соединения с сервером');
        }
    });
}
