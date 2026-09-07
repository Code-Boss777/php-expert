{* Левая колонка - Меню категорий *}
<div id="leftColumn">
    <div id="leftMenu">
        <div class="menuCaption">Меню:</div>

        {foreach from=$rsCategories item=item}
            <!-- Главная категория (например, Телефоны) -->
            <a href="/?controller=category&id={$item['id']}">{$item['name']}</a><br />

            <!-- Если у категории есть дочерние элементы, запускаем вложенный цикл -->
            {if isset($item['children'])}
                {foreach from=$item['children'] item=itemChild}
                    <span style="padding-left: 15px;">-- </span>
                    <!-- ИСПРАВЛЕНО: Передаем ID именно подкатегории ($itemChild['id']) -->
                    <a href="/?controller=category&id={$itemChild['id']}">{$itemChild['name']}</a><br />
                {/foreach}
            {/if}

        {/foreach}
{*блок корзины*}
        <div class="menuCaption">Корзина</div>
{*Ссылка на страницу корзины*}
<a href="/cart/" title="Перейти в корзину">В корзине</a>
{*счетчик товаров*}
<span id="cartCntItems">
{*Если товаров больше 0 показывает число, иначе "Пусто"*}
{if $cartCntItems > 0}
    {$cartCntItems}
    {else}
        пусто
    {/if}
</span>
</div>
</div>