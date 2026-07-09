<?php
/* Smarty version 5.5.1, created on 2026-07-09 12:18:46
  from 'file:leftcolumn.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6a4f75860b7dd7_04292260',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '62e743fb0a8d13471d4976b181725178bb5f719e' => 
    array (
      0 => 'leftcolumn.tpl',
      1 => 1783592323,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a4f75860b7dd7_04292260 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\myshop.local\\www\\views\\default';
?><div id="leftColumn>
<div id=leftMenu>
    <div class="menuCaption">Меню</div>
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('rsCategories'), 'item');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?>
    <a href="#"><?php echo $_smarty_tpl->getValue('item')['name'];?>
</a><br/>
    <?php if ((true && (true && null !== ($_smarty_tpl->getValue('item')['children'] ?? null)))) {?>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('item')['children'], 'itemChild');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('itemChild')->value) {
$foreach1DoElse = false;
?>
            <span style="padding-left: 15px;">-- </span>
            <a href="#"><?php echo $_smarty_tpl->getValue('itemChild')['name'];?>
</a><br/>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);
}
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
</div>
</div>
    <div id=centerColumn>
<?php }
}
