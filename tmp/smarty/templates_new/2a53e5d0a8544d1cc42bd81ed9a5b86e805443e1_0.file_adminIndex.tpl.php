<?php
/* Smarty version 5.5.1, created on 2026-11-24 11:49:40
  from 'file:adminIndex.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6b056bc46c8b85_69320406',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2a53e5d0a8544d1cc42bd81ed9a5b86e805443e1' => 
    array (
      0 => 'adminIndex.tpl',
      1 => 1794559420,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6b056bc46c8b85_69320406 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\myshop.local\\www\\views\\admin';
?><h2>Добро пожаловать в панель управления!</h2>
<p>Здесь вы можете управлять категориями, товарами и заказами.</p>

<div style="display: flex; gap: 20px; margin-top: 20px;">
    <div style="border: 1px solid #ccc; padding: 15px; background: #fff; width: 200px;">
        <h3>Товары</h3>
        <p>Управление каталогом</p>
        <a href="/admin/products/">Перейти &rarr;</a>
    </div>
    <div style="border: 1px solid #ccc; padding: 15px; background: #fff; width: 200px;">
        <h3>Заказы</h3>
        <p>Обработка заказов</p>
        <a href="/admin/orders/">Перейти &rarr;</a>
    </div>
</div><?php }
}
