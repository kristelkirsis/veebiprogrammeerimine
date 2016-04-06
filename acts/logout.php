<?php
//  /acts/logout.php

$sess->deleteSession();
$http->redirect();
?>