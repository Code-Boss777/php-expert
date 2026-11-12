<?php
/* Smarty version 5.5.1, created on 2026-11-12 06:20:56
  from 'file:order.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6af54cb8674827_73400471',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '40a8ea9cb51e52f13839103a765a5145f9400b9d' => 
    array (
      0 => 'order.tpl',
      1 => 1794455200,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6af54cb8674827_73400471 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\myshop.local\\www\\views\\default';
?><h2>Данные заказа</h2>

<form id="frmOrder" action="/cart/saveorder/" method="POST" onsubmit="saveOrder(event); return false;">
    <table border="1" cellpadding="5">
        <tr>
            <th>№</th>
            <th>Наименование</th>
            <th>Количество</th>
            <th>Цена за единицу</th>
            <th>Стоимость</th>
        </tr>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('rsProducts'), 'item');
$_smarty_tpl->getVariable('item')->iteration = 0;
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach2DoElse = false;
$_smarty_tpl->getVariable('item')->iteration++;
$foreach2Backup = clone $_smarty_tpl->getVariable('item');
?>
        <tr>
            <td><?php echo $_smarty_tpl->getVariable('item')->iteration;?>
</td>
            <td>
                <a href="/product/<?php echo $_smarty_tpl->getValue('item')['id'];?>
/"><?php echo $_smarty_tpl->getValue('item')['name'];?>
</a>
            </td>
            <td>
                <span id="itemCnt_<?php echo $_smarty_tpl->getValue('item')['id'];?>
">
                    <input type="hidden" name="itemCnt_<?php echo $_smarty_tpl->getValue('item')['id'];?>
" value="<?php echo $_smarty_tpl->getValue('item')['cnt'];?>
" />
                    <?php echo $_smarty_tpl->getValue('item')['cnt'];?>

                </span>
            </td>
            <td>
                <span id="itemPrice_<?php echo $_smarty_tpl->getValue('item')['id'];?>
">
                    <input type="hidden" name="itemPrice_<?php echo $_smarty_tpl->getValue('item')['id'];?>
" value="<?php echo $_smarty_tpl->getValue('item')['price'];?>
" />
                    <?php echo $_smarty_tpl->getValue('item')['price'];?>

                </span>
            </td>
            <td>
                <span id="itemRealPrice_<?php echo $_smarty_tpl->getValue('item')['id'];?>
">
                    <input type="hidden" name="itemRealPrice_<?php echo $_smarty_tpl->getValue('item')['id'];?>
" value="<?php echo $_smarty_tpl->getValue('item')['realPrice'];?>
" />
                    <?php echo $_smarty_tpl->getValue('item')['realPrice'];?>

                </span>
            </td>
        </tr>
        <?php
$_smarty_tpl->setVariable('item', $foreach2Backup);
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </table>

        <?php if ((true && ($_smarty_tpl->hasVariable('arUser') && null !== ($_smarty_tpl->getValue('arUser') ?? null)))) {?>
                <h3>Данные заказа:</h3>
        <div id="orderUserInfoBox">
            <table>
                <tr>
                    <td>Имя*:</td>
                    <td><input type="text" id="name" name="name" value="<?php echo (($tmp = $_smarty_tpl->getValue('arUser')['name'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" /></td>
                </tr>
                <tr>
                    <td>Тел*:</td>
                    <td><input type="text" id="phone" name="phone" value="<?php echo (($tmp = $_smarty_tpl->getValue('arUser')['phone'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" /></td>
                </tr>
                <tr>
                    <td>Адрес*:</td>
                    <td><textarea id="address" name="address"><?php echo (($tmp = $_smarty_tpl->getValue('arUser')['address'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</textarea></td>
                </tr>
            </table>
        </div>
    <?php } else { ?>
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
    <?php }?>
    
     <button type="submit" class="btn btn-primary">Оформить заказ</button>
</form><?php }
}
