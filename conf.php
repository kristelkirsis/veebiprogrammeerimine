<?php
// /conf.php
error_reporting (E_ALL);
//vajalikud konstandid
define('BASE_DIR', './');

define('SITENAME', 'Veebiprogrammeerimine');

//kaustade konstandid
define('CLASSES_DIR', BASE_DIR.'classes/');
define('TMPL_DIR', BASE_DIR.'tmpl/');
define('ACTS_DIR', BASE_DIR.'acts/');
define('LIB_DIR', BASE_DIR.'lib/');
define('LANG_DIR', BASE_DIR.'lang/');

//võtame vajalikud failid
require_once(CLASSES_DIR.'template.php');
require_once (CLASSES_DIR.'http.php');
require_once (CLASSES_DIR.'linkobject.php');
require_once (CLASSES_DIR. 'mysql.php');
require_once (CLASSES_DIR. 'session.php');

require_once (LIB_DIR.'utils.php');


//defineerime rollide konstandid
define ('ROLE_NONE', 0);
define ('ROLE_ADMIN', 1);
define ('ROLE_USER', 2);

//defineerime vajalikud tegevuste konstandid
define ('DEFAULT_ACT', 'default');

//defineerime keele konstandid
define ('DEFAULT_LANG', 'et');
$siteLangs = array('et' => 'estonian', 'eng' => 'english', 'ru' => 'russian');

require_once ('./dbconf.php');

//valmistame vajalikud objektid
$http = new linkobject();
$db = new mysql (DBHOST, DBUSER, DBPASSW, DBNAME);
$sess = new session($http, $db);

//saame teada, milline on hetke keel
$lang_id = $http->get ('lang_id');
//otsime sobilik keelekonstant - kui keelt pole viib default keelele
if (!isset ($siteLangs[$lang_id])){
    $lang_id = DEFAULT_LANG;
    $http->set('lang_id', $lang_id);
}
define('LANG_ID', $lang_id);
require_once (LIB_DIR.'trans.php');
?>