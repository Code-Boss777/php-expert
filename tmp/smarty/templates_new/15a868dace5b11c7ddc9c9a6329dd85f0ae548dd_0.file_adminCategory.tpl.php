<?php
/* Smarty version 5.5.1, created on 2026-11-24 11:52:06
  from 'file:adminCategory.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6b056c560fa482_49573482',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '15a868dace5b11c7ddc9c9a6329dd85f0ae548dd' => 
    array (
      0 => 'adminCategory.tpl',
      1 => 1795517175,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6b056c560fa482_49573482 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\myshop.local\\www\\views\\admin';
?><h2>Категории</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Родительская категория</th>
        <th>Действие</th>
    </tr>
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('rsCategories'), 'item');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?>
    <tr>
        <td><?php echo $_smarty_tpl->getValue('item')['id'];?>
</td>
        <td>
            <input type="text" id="catName_<?php echo $_smarty_tpl->getValue('item')['id'];?>
" value="<?php echo $_smarty_tpl->getValue('item')['name'];?>
" />
        </td>
        <td>
            <select id="catParent_<?php echo $_smarty_tpl->getValue('item')['id'];?>
">
                <option value="0">Главная категория</option>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('rsCategories'), 'parent');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('parent')->value) {
$foreach1DoElse = false;
?>
                    <?php if ($_smarty_tpl->getValue('parent')['id'] != $_smarty_tpl->getValue('item')['id']) {?>                         <option value="<?php echo $_smarty_tpl->getValue('parent')['id'];?>
" <?php if ($_smarty_tpl->getValue('parent')['id'] == $_smarty_tpl->getValue('item')['parent_id']) {?>selected<?php }?>>
                            <?php echo $_smarty_tpl->getValue('parent')['name'];?>

                        </option>
                    <?php }?>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </select>
        </td>
        <td>
            <input type="button" value="Сохранить" onclick="updateCategory(<?php echo $_smarty_tpl->getValue('item')['id'];?>
);" />
        </td>
    </tr>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
</table><?php }
}
