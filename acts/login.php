<?php
//  /acts/login.php
$login = new template ('login');

$login->set ('error', $sess->get('login_error'));
$sess->del('login_error');

$login->set ('user', tr('Kasutajanimi'));
$login->set ('parool', tr('Parool'));
$login->set ('nupp', tr('Logi sisse'));

$link = $http->getLink(array('act'=>'login_do'));
$login->set ('link', $link);

$tmpl->set ('body', $login->parse());
?>