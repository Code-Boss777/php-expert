<?php
/* Smarty version 5.5.1, created on 2026-07-09 12:18:46
  from 'file:header.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6a4f7586098034_99937070',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3198b13a0cbe62ff8a95f8c112773353ef14889b' => 
    array (
      0 => 'header.tpl',
      1 => 1782213946,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:leftcolumn.tpl' => 1,
  ),
))) {
function content_6a4f7586098034_99937070 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\myshop.local\\www\\views\\default';
?>проверка связи 
<html>
    <head>
    <title><?php echo $_smarty_tpl->getValue('pageTitle');?>
</title>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getValue('TemplateWebPath');?>
css/myshopmain.css" type="text/css">
    </head>
    <body>
    <div id="header">
    <h1>my shop - Интернет магазин </h1>
    </div>

    <?php $_smarty_tpl->renderSubTemplate('file:leftcolumn.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

    <div id="centerColumn">

    centerColumn
<?php }
}
