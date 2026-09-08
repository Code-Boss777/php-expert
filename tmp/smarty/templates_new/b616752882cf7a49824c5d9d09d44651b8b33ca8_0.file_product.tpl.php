<?php
/* Smarty version 5.5.1, created on 2026-09-08 11:55:59
  from 'file:product.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6a9fdbaf061946_22964206',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b616752882cf7a49824c5d9d09d44651b8b33ca8' => 
    array (
      0 => 'product.tpl',
      1 => 1788856772,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a9fdbaf061946_22964206 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\myshop.local\\www\\views\\default';
?>
<h3><?php ob_start();
echo $_smarty_tpl->getValue('rsProduct')['name'];
$_prefixVariable1 = ob_get_clean();
echo $_prefixVariable1;?>
</h3>

<img width="575" src="/images/products/<?php ob_start();
echo $_smarty_tpl->getValue('rsProduct')['image'];
$_prefixVariable2 = ob_get_clean();
echo $_prefixVariable2;?>
" alt="<?php ob_start();
echo $_smarty_tpl->getValue('rsProduct')['name'];
$_prefixVariable3 = ob_get_clean();
echo $_prefixVariable3;?>
">

<p><strong>Стоимость:</strong> <?php ob_start();
echo $_smarty_tpl->getValue('rsProduct')['price'];
$_prefixVariable4 = ob_get_clean();
echo $_prefixVariable4;?>
 руб.</p>


<?php ob_start();
if (!$_smarty_tpl->getValue('itemInCart')) {
$_prefixVariable5 = ob_get_clean();
echo $_prefixVariable5;?>

    <a id="addCart_<?php ob_start();
echo $_smarty_tpl->getValue('rsProduct')['id'];
$_prefixVariable6 = ob_get_clean();
echo $_prefixVariable6;?>
" href="#" class="btn btn-primary" onclick="addToCart(<?php ob_start();
echo $_smarty_tpl->getValue('rsProduct')['id'];
$_prefixVariable7 = ob_get_clean();
echo $_prefixVariable7;?>
); return false;">Добавить в корзину</a>
<?php ob_start();
}
$_prefixVariable8 = ob_get_clean();
echo $_prefixVariable8;?>


<?php ob_start();
if ($_smarty_tpl->getValue('itemInCart')) {
$_prefixVariable9 = ob_get_clean();
echo $_prefixVariable9;?>

    <a id="removeCart_<?php ob_start();
echo $_smarty_tpl->getValue('rsProduct')['id'];
$_prefixVariable10 = ob_get_clean();
echo $_prefixVariable10;?>
" href="#" class="btn btn-danger" onclick="removeFromCart(<?php ob_start();
echo $_smarty_tpl->getValue('rsProduct')['id'];
$_prefixVariable11 = ob_get_clean();
echo $_prefixVariable11;?>
); return false;">Удалить из корзины</a>
<?php ob_start();
}
$_prefixVariable12 = ob_get_clean();
echo $_prefixVariable12;?>


<p><strong>Описание:</strong><br /><?php ob_start();
echo $_smarty_tpl->getValue('rsProduct')['description'];
$_prefixVariable13 = ob_get_clean();
echo $_prefixVariable13;?>
</p>

<a href="javascript:history.back();">Назад к списку товаров</a><?php }
}
