<?php
/* Smarty version 5.5.1, created on 2026-09-07 13:09:47
  from 'file:product.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6a9e9b7b55bf30_97037703',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b616752882cf7a49824c5d9d09d44651b8b33ca8' => 
    array (
      0 => 'product.tpl',
      1 => 1788779273,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a9e9b7b55bf30_97037703 (\Smarty\Template $_smarty_tpl) {
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

<a id="addCart_<?php echo $_smarty_tpl->getValue('rsProduct')['id'];?>
" href="#" class="btn btn-primary" onclick="addToCart(<?php echo $_smarty_tpl->getValue('rsProduct')['id'];?>
); return false;">Добавить в корзину</a>
<a id="removeCart_{{ $rsProduct['id'] }}" href="#" class="btn btn-danger" style="display:none;" onclick="removeFromCart({{ $rsProduct['id'] }}); return false;">Удалить из корзины</a>
<p><strong>Описание:</strong><br /><?php ob_start();
echo $_smarty_tpl->getValue('rsProduct')['description'];
$_prefixVariable5 = ob_get_clean();
echo $_prefixVariable5;?>
</p>

<a href="javascript:history.back();">Назад к списку товаров</a><?php }
}
