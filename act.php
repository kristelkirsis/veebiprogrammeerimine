<?php
//  /act.php
if (!defined('BASE_DIR')){
    exit;
}
$act = $http->get('act');
echo $act;
$fn = ACTS_DIR.str_replace('.', '/', '$act').'php';                 //fn=faili nimi

if (file_exists($fn) and is_file($fn) and is_readable($fn)){
    require_once ($fn);
}
else {
    $fn = ACTS_DIR.DEFAULT_ACT.'php';
    $http->set ('act', DEFAULT_ACT);
    require_once ($fn);
}
?>