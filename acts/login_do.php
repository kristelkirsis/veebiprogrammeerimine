<?php
//  /acts/login_do.php

$username = $http->get ('username');
$password = $http->get ('password');

$sql = 'SELECT * FROM user WHERE '.'username='.fixDb($username).' AND'.'password='.fixDb(md5($password)).' AND'.
    'is_active=1';

$res = $db->getArray($sql);
if ($res === false) {
    //koostame veateate
    $sess->set('login error', tr('Viga sisselogimisel'));
    //suuname tagasi sisselogimislehele koos veateatega
    $link = $http->getLink (array('act'=>'login'));
    $http->redirect($link);
}
else {
    //avame kasutajale sessiooni ja
    $sess->createSession($res[0]);
    // suuname pealehele, aga sisselogitud kasutaja lehele
    $http->redirect();
}
?>