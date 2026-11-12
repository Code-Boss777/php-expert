<h2>Корзина</h2>

{if $rsProducts|count == 0}
    <p>Корзина пуста</p>
{else}
    <h3>Данные заказа</h3>
    
    {* 1. ОТКРЫВАЕМ ФОРМУ ЗДЕСЬ (перед таблицей) *}
    <form action="/cart/order/" method="POST">
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
                    {* 2. ДОБАВЛЯЕМ АТРИБУТ NAME *}
                    <input type="text" 
                           id="itemCnt_{$item['id']}"
                           name="itemCnt_{$item['id']}"
                           value="{$item['quantity']}"
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
                        {math equation="x * y" x=$item['price'] y=$item['quantity']}
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
            <tr>ы
                <td colspan="5"></td>
                <td>
                    {* 3. КНОПКА ВНУТРИ ФОРМЫ И ТАБЛИЦЫ *}
                    <input type="submit" value="Оформить заказ" />
                </td>
            </tr>
        </table>
    </form> {* 4. ЗАКРЫВАЕМ ФОРМУ ЗДЕСЬ *}
{/if}

<a href="/">Продолжить покупки</a>