<?php
/* Smarty version 5.5.1, created on 2026-11-24 11:52:06
  from 'file:adminHeader.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6b056c560e6236_46864783',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '541026a7702a263447ed38015321cd70ab2288cb' => 
    array (
      0 => 'adminHeader.tpl',
      1 => 1795514745,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:adminLeftcolumn.tpl' => 1,
  ),
))) {
function content_6b056c560e6236_46864783 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\myshop.local\\www\\views\\admin';
?><!DOCTYPE html>
<html>
<head>
    <title><?php echo $_smarty_tpl->getValue('pageTitle');?>
</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getValue('TemplateWebPath');?>
css/main.css" type="text/css" />
    <?php echo '<script'; ?>
 src="/js/jquery-1.7.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/js/admin.js"><?php echo '</script'; ?>
> <!-- ТУТ ДОБАВЛЕН СЛЭШ -->
</head>
<body>
    <div id="header">
        <h1>Управление сайтом</h1>
    </div>
    
    <?php $_smarty_tpl->renderSubTemplate('file:adminLeftcolumn.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    
    <div id="centerColumn"><?php }
}
