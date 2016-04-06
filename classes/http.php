<?php

//   /classes/http.php - veateated; predefined muutujad! _get massiivi tüüpi muutuja, mahutab palju elemente; kirjutan funk, mis võtab massiivist
function fixHtml($val){
    return htmlentities($val);
}

class http {
    var $vars = array ();  // siia panen päringu tulemused, kasutaja poolsed andmed
    var $server = array(); // serveri poolsed andmed
    var $cookie = array (); // infot kasutaja korjab nt

    function __construct(){
        $this->init();
        $this->initConst();
    } //konstruktor
    function init() {
        $this->vars = array_merge ($_GET, $_POST, $_FILES);	//post get ja files võivad edastada kasutaja andmeid  dollar this - kui tahan just tema poole pöörduda - vot selle klassi juurde
        $this->server = $_SERVER;
        $this->cookie = $_COOKIE;

        function initConst (){
            $vars = array ('REMOTE_ADDR', 'PHP_SELF', 'SCRIPT_NAME', 'HTTP_HOST');
            foreach ($vars as $var){
                if(!defined ($var) and isset (this->server[$var])){
                    define ($var, $this->server[$var]);
                }
			}
        }
    }  //initsialiseerimine?
    function get($name, $fix = false){
        if (isset($this->vars[$name])){
            if ($fix){
                return fixHtml($this->vars[$name]);
            }
            return $this->vars[$name];
        }
        return false;
    } //get

    function set($name, $val){
        $this->vars [$name] = $val;
    }

    function  del($name){						//kustutan nime ja väärtus kustub koos sellega; tühjendame neid andmeid
        if (isset($this->vars[$name])){
            unset ($this->vars[$name]);
        }
    }	//del

    function redirect($url = false){
        global $sess;
        $this->flush();

        if ($url === false){
            $url = $this->getLink();
        }
        $url = str_replace ('&amp;', '&', $url);
        header('Location: '.$url);
        exit;
    } //redirect lõpp

} //http classi lõpp



testimiseks, aga nii ei tehta!
$http = new http();

echo '<pre>';				//pre predefined ja teeb reavahetuse.. kasutajale ei väljastata nii  pre asemel võib ka var_dump
print_r ($http->$vars);
print_r ($http->$server);
print_r ($http->$cookie);
echo '</pre>';

$http = new http();
echo '<pre>';
print_r ($http->$vars);
echo $http->get ('nimi');
echo $http->get ('perenimi');   //kui tahan fixida siis echo $http->get ('perenimi', true); get ei ole turvaline, post parem
echo '</pre>';

$http = new http();
$http->set ('eesnimi', 'Anna');   //emuleerime situatsiooni, kui saadetakse andmed postiga; need väärtused serveris defineeritud, need kustutatakse sessiooni lõppemise, juhu kui session kasutusel
$http->set ('perenimi', 'K');
echo '<pre>';
print_r ($http->$vars);
echo '</pre>';
echo $http->get ('eesnimi'). '<br/>';
echo $http->get ('perenimi');

?>
