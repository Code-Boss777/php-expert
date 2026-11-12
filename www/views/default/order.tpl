{* Страница заказа *}
<h2>Данные заказа</h2>

<form id="frmOrder" action="/cart/saveorder/" method="POST" onsubmit="saveOrder(event); return false;">
    <table border="1" cellpadding="5">
        <tr>
            <th>№</th>
            <th>Наименование</th>
            <th>Количество</th>
            <th>Цена за единицу</th>
            <th>Стоимость</th>
        </tr>
        {foreach $rsProducts as $item}
        <tr>
            <td>{$item@iteration}</td>
            <td>
                <a href="/product/{$item['id']}/">{$item['name']}</a>
            </td>
            <td>
                <span id="itemCnt_{$item['id']}">
                    <input type="hidden" name="itemCnt_{$item['id']}" value="{$item['cnt']}" />
                    {$item['cnt']}
                </span>
            </td>
            <td>
                <span id="itemPrice_{$item['id']}">
                    <input type="hidden" name="itemPrice_{$item['id']}" value="{$item['price']}" />
                    {$item['price']}
                </span>
            </td>
            <td>
                <span id="itemRealPrice_{$item['id']}">
                    <input type="hidden" name="itemRealPrice_{$item['id']}" value="{$item['realPrice']}" />
                    {$item['realPrice']}
                </span>
            </td>
        </tr>
        {/foreach}
    </table>

        {if isset($arUser)}
        {* Если пользователь авторизован, показываем его данные *}
        <h3>Данные заказа:</h3>
        <div id="orderUserInfoBox">
            <table>
                <tr>
                    <td>Имя*:</td>
                    <td><input type="text" id="name" name="name" value="{$arUser['name']|default:''}" /></td>
                </tr>
                <tr>
                    <td>Тел*:</td>
                    <td><input type="text" id="phone" name="phone" value="{$arUser['phone']|default:''}" /></td>
                </tr>
                <tr>
                    <td>Адрес*:</td>
                    <td><textarea id="address" name="address">{$arUser['address']|default:''}</textarea></td>
                </tr>
            </table>
        </div>
    {else}
        {* Если НЕ авторизован, показываем логин и регистрацию *}
        <div id="loginBox">
            <h3>Авторизация</h3>
            email:<br />
            <input type="text" id="loginEmail" name="loginEmail" value="" /><br />
            пароль:<br />
            <input type="password" id="loginPwd" name="loginPwd" value="" /><br />
            <input type="button" onclick="login();" value="Войти" />
        </div>

        <div id="registerBox">
            <h3>Регистрация</h3>
            email*:<br />
            <input type="text" id="email" name="email" value="" /><br />
            пароль*:<br />
            <input type="password" id="pwd1" name="pwd1" value="" /><br />
            повторить пароль*:<br />
            <input type="password" id="pwd2" name="pwd2" value="" /><br />
            Имя*:<br />
            <input type="text" id="name" name="name" value="" /><br />
            Тел*:<br />
            <input type="text" id="phone" name="phone" value="" /><br />
            Адрес*:<br />
            <input type="text" id="address" name="address" value="" /><br />
            <input type="button" onclick="registerNewUser();" value="Зарегистрироваться" />
        </div>
    {/if}
    
     <button type="submit" class="btn btn-primary">Оформить заказ</button>
</form>