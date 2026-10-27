<?php
/* Smarty version 5.5.1, created on 2026-10-27 11:57:28
  from 'file:user.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_6ae08398e3f5f4_57803781',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3a7a0c8076137a23231301654248304bdb616a05' => 
    array (
      0 => 'user.tpl',
      1 => 1793098606,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6ae08398e3f5f4_57803781 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\myshop.local\\www\\views\\default';
?><h2>Ваши регистрационные данные:</h2>

<table border="0">
    <tr>
        <td>Логин (email)</td>
        <td><?php echo $_smarty_tpl->getValue('arUser')['email'];?>
</td>
    </tr>
    <tr>
        <td>Имя</td>
        <td>
            <input type="text" id="newName" value="<?php echo $_smarty_tpl->getValue('arUser')['name'];?>
" />
        </td>
    </tr>
    <tr>
        <td>Тел</td>
        <td>
            <input type="text" id="newPhone" value="<?php echo (($tmp = $_smarty_tpl->getValue('arUser')['phone'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" />
        </td>
    </tr>
    <tr>
        <td>Адрес</td>
        <td>
            <textarea id="newAdress"><?php echo (($tmp = $_smarty_tpl->getValue('arUser')['address'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</textarea>
        </td>
    </tr>
    <tr>
        <td>Новый пароль</td>
        <td>
            <input type="password" id="newPwd1" value="" />
        </td>
    </tr>
    <tr>
        <td>Повтор пароля</td>
        <td>
            <input type="password" id="newPwd2" value="" />
        </td>
    </tr>
    <tr>
        <td>Для того чтобы сохранить данные введите текущий пароль</td>
        <td>
            <input type="password" id="curPwd" value="" />
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
            <input type="button" value="Сохранить изменения" onclick="updateUserData();" />
        </td>
    </tr>
</table><?php }
}
