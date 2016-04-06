<?php
require_once ('conf.php');

//loome pealehe template ja täidame sisuga ning välastame
$tmpl = new template('main');

require_once ('lang.php');
require_once ('act.php');
require_once ('menu.php');


$tmpl->set('nav_bar', $sess->user_data['username']);
$tmpl->set('lang_bar', 'Siia tuleb kunagi keelevahetus');
$tmpl->set('body', 'Lehe sisu');
$tmpl->add ('body', '<br/> ja midagi veel');

//väljastame täidetud template
echo $tmpl->parse();
// sessiooni uuendus
$sess->flush();
//andmebaasi päringute kontroll
$db->showHistory();

?>