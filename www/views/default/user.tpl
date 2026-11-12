<h2>Ваши регистрационные данные:</h2>

<table border="0">
    <tr>
        <td>Логин (email)</td>
        <td>{$arUser['email']}</td>
    </tr>
    <tr>
        <td>Имя</td>
        <td>
            <input type="text" id="newName" value="{$arUser['name']}" />
        </td>
    </tr>
    <tr>
        <td>Тел</td>
        <td>
            <input type="text" id="newPhone" value="{$arUser['phone']|default:''}" />
        </td>
    </tr>
    <tr>
        <td>Адрес</td>
        <td>
            <textarea id="newAdress">{$arUser['address']|default:''}</textarea>
        </td>
    </tr>
    <tr>
        <td>Новый пароль</td>
        <td>
            <input type="password" id="newPwd1" value="" />
        </td>
    </tr>
    <tr>
        <td>Повтор пароля</td>
        <td>
            <input type="password" id="newPwd2" value="" />
        </td>
    </tr>
    <tr>
        <td>Для того чтобы сохранить данные введите текущий пароль</td>
        <td>
            <input type="password" id="curPwd" value="" />
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <input type="button" value="Сохранить изменения" onclick="updateUserData();" />
        </td>
    </tr>
</table>

<h3>Заказы:</h3>

{if $rsOrders|count > 0}
    <table border="1" cellpadding="5">
        <tr>
            <th>№</th>
            <th>Действие</th>
            <th>ID заказа</th>
            <th>Статус</th>
            <th>Дата создания</th>
            <th>Дата оплаты</th>
            <th>Дополнительная информация</th>
        </tr>
        
        {* Обрати внимание: убрали name=orders и поменяли вывод итерации *}
        {foreach $rsOrders as $item}
        <tr>
            <td>{$item@iteration}</td>
            <td>
                <a href="#" onclick="showProductsInOrder({$item['id']}); return false;">Показать товар заказа</a>
            </td>
            <td>{$item['id']}</td>
            <td>{$item['status']}</td>
            <td>{$item['date_created']}</td>
            <td>{$item['date_payment']}</td>
            <td>{$item['comment']}</td>
        </tr>
        {* Скрытая строка для AJAX *}
        <tr id="orderDetails_{$item['id']}" style="display: none; background-color: #f9f9f9;">
            <td colspan="7">
                <div id="orderDetailsContent_{$item['id']}">Загрузка...</div>
            </td>
        </tr>
        {/foreach}
        
    </table>
{else}
    <p>У вас пока нет заказов.</p>
{/if}