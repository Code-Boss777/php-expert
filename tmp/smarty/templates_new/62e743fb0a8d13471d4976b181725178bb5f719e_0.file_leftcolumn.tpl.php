<?php
/* Smarty version 5.5.1, created on 2026-09-14 09:57:06
  from 'file:leftcolumn.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6aa7a8d2bd4ee9_18286756',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '62e743fb0a8d13471d4976b181725178bb5f719e' => 
    array (
      0 => 'leftcolumn.tpl',
      1 => 1789372179,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa7a8d2bd4ee9_18286756 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\myshop.local\\www\\views\\default';
?><div id="leftColumn">
    <div id="leftMenu">
        <div class="menuCaption">Меню:</div>

        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('rsCategories'), 'item');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?>
            <!-- Главная категория (например, Телефоны) -->
            <a href="/?controller=category&id=<?php echo $_smarty_tpl->getValue('item')['id'];?>
"><?php echo $_smarty_tpl->getValue('item')['name'];?>
</a><br />

            <!-- Если у категории есть дочерние элементы, запускаем вложенный цикл -->
            <?php if ((true && (true && null !== ($_smarty_tpl->getValue('item')['children'] ?? null)))) {?>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('item')['children'], 'itemChild');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('itemChild')->value) {
$foreach1DoElse = false;
?>
                    <span style="padding-left: 15px;">-- </span>
                    <!-- ИСПРАВЛЕНО: Передаем ID именно подкатегории ($itemChild['id']) -->
                    <a href="/?controller=category&id=<?php echo $_smarty_tpl->getValue('itemChild')['id'];?>
"><?php echo $_smarty_tpl->getValue('itemChild')['name'];?>
</a><br />
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            <?php }?>

        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        <div id="registerBox">
    <div class="menuCaption showHidden" onclick="showRegisterBox();">Регистрация</div>
    <div id="registerBoxHidden" class="hideme">
        email:<br />
        <input type="text" id="email" name="email" value="" /><br />
        пароль:<br />
        <input type="password" id="pwd1" name="pwd1" value="" /><br />
        повторить пароль:<br />
        <input type="password" id="pwd2" name="pwd2" value="" /><br />
        <input type="button" onclick="registerNewUser();" value="Зарегистрироваться" />
    </div>
</div>
        <div class="menuCaption">Корзина</div>
<a href="/cart/" title="Перейти в корзину">В корзине</a>
<span id="cartCntItems">
<?php if ($_smarty_tpl->getValue('cartCntItems') > 0) {?>
    <?php echo $_smarty_tpl->getValue('cartCntItems');?>

    <?php } else { ?>
        пусто
    <?php }?>
</span>
</div>
</div><?php }
}
