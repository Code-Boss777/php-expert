<?php
/* Smarty version 5.5.1, created on 2026-11-12 06:56:20
  from 'file:user.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6af555046d3bf0_38948218',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3a7a0c8076137a23231301654248304bdb616a05' => 
    array (
      0 => 'user.tpl',
      1 => 1794461217,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6af555046d3bf0_38948218 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\myshop.local\\www\\views\\default';
?><h2>Ваши регистрационные данные:</h2>

<table border="0">
    <tr>
        <td>Логин (email)</td>
        <td><?php echo $_smarty_tpl->getValue('arUser')['email'];?>
</td>
    </tr>
    <tr>
        <td>Имя</td>
        <td>
            <input type="text" id="newName" value="<?php echo $_smarty_tpl->getValue('arUser')['name'];?>
" />
        </td>
    </tr>
    <tr>
        <td>Тел</td>
        <td>
            <input type="text" id="newPhone" value="<?php echo (($tmp = $_smarty_tpl->getValue('arUser')['phone'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />
        </td>
    </tr>
    <tr>
        <td>Адрес</td>
        <td>
            <textarea id="newAdress"><?php echo (($tmp = $_smarty_tpl->getValue('arUser')['address'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</textarea>
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

<?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('rsOrders')) > 0) {?>
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
        
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('rsOrders'), 'item');
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
                <a href="#" onclick="showProductsInOrder(<?php echo $_smarty_tpl->getValue('item')['id'];?>
); return false;">Показать товар заказа</a>
            </td>
            <td><?php echo $_smarty_tpl->getValue('item')['id'];?>
</td>
            <td><?php echo $_smarty_tpl->getValue('item')['status'];?>
</td>
            <td><?php echo $_smarty_tpl->getValue('item')['date_created'];?>
</td>
            <td><?php echo $_smarty_tpl->getValue('item')['date_payment'];?>
</td>
            <td><?php echo $_smarty_tpl->getValue('item')['comment'];?>
</td>
        </tr>
                <tr id="orderDetails_<?php echo $_smarty_tpl->getValue('item')['id'];?>
" style="display: none; background-color: #f9f9f9;">
            <td colspan="7">
                <div id="orderDetailsContent_<?php echo $_smarty_tpl->getValue('item')['id'];?>
">Загрузка...</div>
            </td>
        </tr>
        <?php
$_smarty_tpl->setVariable('item', $foreach2Backup);
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        
    </table>
<?php } else { ?>
    <p>У вас пока нет заказов.</p>
<?php }
}
}
