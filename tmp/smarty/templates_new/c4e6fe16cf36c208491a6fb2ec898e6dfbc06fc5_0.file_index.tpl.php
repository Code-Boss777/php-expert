<?php
/* Smarty version 5.5.1, created on 2026-07-24 11:40:06
  from 'file:index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6a6332f671e226_40026811',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c4e6fe16cf36c208491a6fb2ec898e6dfbc06fc5' => 
    array (
      0 => 'index.tpl',
      1 => 1784886003,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a6332f671e226_40026811 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\myshop.local\\www\\views\\default';
?><div id="centerColumn">
    
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('rsProducts'), 'item');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach2DoElse = false;
?>
        <div style="float: left; padding: 0px 30px 40px 0px; width: 150px; text-align: center;">
            <a href="/product/<?php echo $_smarty_tpl->getValue('item')['id'];?>
/">
                <img src="/images/products/<?php echo $_smarty_tpl->getValue('item')['image'];?>
" width="100" alt="<?php echo $_smarty_tpl->getValue('item')['name'];?>
" />
            </a>
            <br />
            <a href="/product/<?php echo $_smarty_tpl->getValue('item')['id'];?>
/"><?php echo $_smarty_tpl->getValue('item')['name'];?>
</a>
            <br />
            <span style="color: #e44b4b; font-weight: bold;"><?php echo $_smarty_tpl->getValue('item')['price'];?>
 руб.</span>
        </div>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    
</div><?php }
}
