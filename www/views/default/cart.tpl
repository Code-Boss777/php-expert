<h2>Корзина</h2>

{if $rsProducts|count == 0}
    <p>Корзина пуста</p>
{else}
    <h3>Данные заказа</h3>
    <table border="1" cellpadding="5">
        <tr>
            <th>№</th>
            <th>Наименование</th>
            <th>Количество</th>
            <th>Цена за единицу</th>
            <th>Цена</th>
            <th>Действие</th>
        </tr>
        {foreach $rsProducts as $item}
    <tr>
        <td>{$item@iteration}</td>
        <td>
            <a href="/product/{$item['id']}/">{$item['name']}</a>
        </td>
        <td>
            <input type="text" 
                   id="itemCnt_{$item['id']}" 
                   value="1" 
                   size="3"
                   onchange="conversionPrice({$item['id']});">
        </td>
        <td>
            <span id="itemPrice_{$item['id']}" value="{$item['price']}">
                {$item['price']}
            </span>
        </td>
        <td>
            <span id="itemRealPrice_{$item['id']}">
                {$item['price']}
            </span>
        </td>
        <td>
            <a id="removeCart_{$item['id']}" 
               href="#" 
               onclick="removeFromCart({$item['id']}); return false;" 
               title="Удалить из корзины">Удалить</a>
               
            <a id="addCart_{$item['id']}" 
               class="hideme" 
               href="#" 
               onclick="addToCart({$item['id']}); return false;" 
               title="Восстановить">Восстановить</a>
        </td>
    </tr>
{/foreach}
        <tr>
            <td colspan="4"><strong>Итого:</strong></td>
            <td><strong id="totalPrice"></strong></td>
            <td></td>
        </tr>
    </table>
{/if}

<a href="/">Продолжить покупки</a>