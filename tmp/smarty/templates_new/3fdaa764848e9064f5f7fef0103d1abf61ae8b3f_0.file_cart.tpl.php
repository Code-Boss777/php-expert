<?php
/* Smarty version 5.5.1, created on 2026-09-14 09:46:31
  from 'file:cart.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6aa7a657bfc145_64596799',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3fdaa764848e9064f5f7fef0103d1abf61ae8b3f' => 
    array (
      0 => 'cart.tpl',
      1 => 1789033233,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa7a657bfc145_64596799 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\myshop.local\\www\\views\\default';
?><h2>Корзина</h2>

<?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('rsProducts')) == 0) {?>
    <p>Корзина пуста</p>
<?php } else { ?>
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
            <input type="text" 
                   id="itemCnt_<?php echo $_smarty_tpl->getValue('item')['id'];?>
" 
                   value="1" 
                   size="3"
                   onchange="conversionPrice(<?php echo $_smarty_tpl->getValue('item')['id'];?>
);">
        </td>
        <td>
            <span id="itemPrice_<?php echo $_smarty_tpl->getValue('item')['id'];?>
" value="<?php echo $_smarty_tpl->getValue('item')['price'];?>
">
                <?php echo $_smarty_tpl->getValue('item')['price'];?>

            </span>
        </td>
        <td>
            <span id="itemRealPrice_<?php echo $_smarty_tpl->getValue('item')['id'];?>
">
                <?php echo $_smarty_tpl->getValue('item')['price'];?>

            </span>
        </td>
        <td>
            <a id="removeCart_<?php echo $_smarty_tpl->getValue('item')['id'];?>
" 
               href="#" 
               onclick="removeFromCart(<?php echo $_smarty_tpl->getValue('item')['id'];?>
); return false;" 
               title="Удалить из корзины">Удалить</a>
               
            <a id="addCart_<?php echo $_smarty_tpl->getValue('item')['id'];?>
" 
               class="hideme" 
               href="#" 
               onclick="addToCart(<?php echo $_smarty_tpl->getValue('item')['id'];?>
); return false;" 
               title="Восстановить">Восстановить</a>
        </td>
    </tr>
<?php
$_smarty_tpl->setVariable('item', $foreach2Backup);
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        <tr>
            <td colspan="4"><strong>Итого:</strong></td>
            <td><strong id="totalPrice"></strong></td>
            <td></td>
        </tr>
    </table>
<?php }?>

<a href="/">Продолжить покупки</a><?php }
}
