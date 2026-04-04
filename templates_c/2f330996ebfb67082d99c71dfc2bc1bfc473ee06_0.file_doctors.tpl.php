<?php
/* Smarty version 5.8.0, created on 2026-04-04 19:40:40
  from 'file:guest/doctors.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d16938e637d4_95879221',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2f330996ebfb67082d99c71dfc2bc1bfc473ee06' => 
    array (
      0 => 'guest/doctors.tpl',
      1 => 1775331323,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../layout/header.tpl' => 1,
    'file:../layout/footer.tpl' => 1,
  ),
))) {
function content_69d16938e637d4_95879221 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\thanh\\Documents\\Clinic\\templates\\guest';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bác sĩ</title>
</head>
<body>
    <?php $_smarty_tpl->renderSubTemplate("file:../layout/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    <?php $_smarty_tpl->renderSubTemplate("file:../layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
</body>
</html><?php }
}
