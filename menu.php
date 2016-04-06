<?php
// menu.php
if (!defined('BASE_DIR')){
    exit;
}
$menu = new template ('menu.menu');
$item = new template ('menu.item');

if (USER_ID != ROLE_NONE) {
    $item->set('name', 'Logi v&auml;ja');
    $link = $http->getLink(array('act' => 'logout'));
    $item->set('link', $link);
    $menu->add('items', $item->parse());
}
$tmpl->set('menyy', $menu->parse());
?>