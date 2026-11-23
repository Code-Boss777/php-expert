<?php
/* Smarty version 5.5.1, created on 2026-11-23 09:38:15
  from 'file:adminLeftcolumn.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6b03fb7731ab40_14036852',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '14a42b7ad3b269bc3e6813f4d9b90edf0fd40e3f' => 
    array (
      0 => 'adminLeftcolumn.tpl',
      1 => 1794559371,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6b03fb7731ab40_14036852 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\myshop.local\\www\\views\\admin';
?><div id="leftColumn">
    <div id="leftMenu">
        <div class="menuCaption">Меню:</div>
        <a href="/admin/">Главная</a><br />
        <a href="/admin/category/">Категории</a><br />
        <a href="/admin/products/">Товары</a><br />
        <a href="/admin/orders/">Заказы</a><br />
        <hr />
        <a href="/">Вернуться на сайт</a><br />
        <a href="/user/logout/">Выход</a>
    </div>
</div><?php }
}
