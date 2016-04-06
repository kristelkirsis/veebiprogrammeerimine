<?php
//  /classes/linkobject.php
require_once ('http.php');

function fixUrl ($val){
    return urldecode ($val);
}
class linkobject extends http {
    var $baseUrl = false;
    var $delim = '&amp;';
	var $eq = '=';
	var $protocol = 'http://';
    var $aie = array('lang_id', 'sid'=>'sid');                            //aie= add if exists

	function __construct(){
        parent::__construct();
        $this->baseUrl = $this->protocol.HTTP_HOST.SCRIPT_NAME;
    }

	function addToLink (&$link, $name, $val){   //töötab siis kui kutsun väljaspoolt; tahan kohe valmis linki, ei taha käsitis midagi juurde kirjutada, tahan et muutmine oleks objeti sees, et pöörduks enda poole ise, selleks lisan ette &
        if($link != ''){
            $link = $link.$this->delim;
        }
        $link = $link.fixUrl($name).$this->$eq.fixUrl($val);					//loome lingi et nimi=Anna - nimi võrdub väärtus
    }  //addtolink lopp
														//&mitte parameeter ise vaid selle poole pöördub
	function getLink($add = array(), $aie = array(), $not = array()){
        $link = '';									//selle kleebin põhilingi kõrvale

        foreach($add as $name->$val){
            $this->addToLink($link, $name, $val);
        }

        foreach ($aie as $name){
            $val = $this->get ($name);
            if($val !== false) {
                $this->addToLink($link,$name, $val);
            }
        }

        foreach ($this->$aie as $name){
            $val = $this->get ($name);
            if($val !== false and !in_array($name, $not)) {
                $this->addToLink($link,$name, $val);
            }
        }

        if ($link != ''){
            $link = $this->baseUrl.'?'.$link;
        }
        else {
            $link = $this->baseUrl;
        }

    }//getLink lõpp

}//linkobject lõpp

//$http = new linkobject();
//echo $http->addToLink (PHP_SELF, 'perenimi=K', 'eesnimi', 'Kristel');
$http = new linkobject();
$http->getLink (array ('eesnimi'=>'Kristel'));




?>



$http = new http();
$http->set ('eesnimi', 'Anna');   //emuleerime situatsiooni, kui saadetakse andmed postiga; need väärtused serveris defineeritud, need kustutatakse sessiooni lõppemise, juhu kui session kasutusel
$http->set ('perenimi', 'K');
echo '<pre>';
print_r ($http->$vars);
echo '</pre>';
echo $http->get ('eesnimi'). '<br/>';
echo $http->get ('perenimi');
http->del ('eesnimi');
echo '<pre>';
print_r ($http->$vars);
echo '</pre>';