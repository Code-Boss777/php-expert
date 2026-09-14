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
        {* ===== БЛОК РЕГИСТРАЦИИ ===== *}
<div id="registerBox">
    <div class="menuCaption showHidden" onclick="showRegisterBox();">Регистрация</div>
    <div id="registerBoxHidden" class="hideme">
        email:<br />
        <input type="text" id="email" name="email" value="" /><br />
        пароль:<br />
        <input type="password" id="pwd1" name="pwd1" value="" /><br />
        повторить пароль:<br />
        <input type="password" id="pwd2" name="pwd2" value="" /><br />
        <input type="button" onclick="registerNewUser();" value="Зарегистрироваться" />
    </div>
</div>
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