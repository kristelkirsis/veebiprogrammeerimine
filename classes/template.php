<?php
//  /classes/template.php 			klass template - sõltub template failist, peab olema sisu ja väärtused kas template kataloog on kättesaadav jnejne

if(!defined ('TMPL_DIR'))
{
    define ('TMPL_DIR', '../tmpl/');
}
class template {
    //klassi omadused
    var $file = '';			//tempate fail
    var $content = false;	//sisu
    var $vars = array ();	//väärtused

    function __construct ($f){
        $this->file = $f;
        $this->loadFile();
    } //construct lopp

    function loadFile(){
        $f = $this->file;        //kas template kaust olemas ehk kas ei ole.. siis väljas veateate.. kui olemas, siis ok ju
        if (!is_dir(TMPL_DIR))
        {
            echo 'kataloogi '.TMPL_DIR.' ei ole leitud<br/>';
			exit;
		}
} //loadfile lopp
//kas fail on vastavate õigustega
if (file_exists($f) and is_file($f) and is_readable($f))
{
    //loeme faili sisu $this->content sisse
}
//kui faili nimi on antud koos .html ja ilma kataloogi nimeta:
$f = TMPL_DIR.$this->file;
if
{

}
//lubame kasutajale lisada ainult template nimi, oilma laienduseta
$f = TMPL_DIR.$this->file).'.html;
            if(file_exists($f) and is_file($f) and is_readable($f))
            {
                $this->readFile($f);
            }
            $f = TMPL_DIR.str_replace('.', '/', $this->file).'.html;
if (file_exists($f) and is_file($f) and is_readable($f))
	} //loadfile func lõpp

	function readFile($f)
    {
        /*
        $fp = fopen ($f, 'rb');
        $this->content = fread($fp, filesize($f));
        fclose($fp)    kõik see sama asi, aga lühemalt järgmises reas
        */
        $this->content = file_get_contents($f);
    }//readFile funk lõpp

	//template sisu määramine
	//tekitame paar tempate_element=väärtused
	function set($name, $val)
    {
        $this->vars[$name] = $val;
    }//set funk lõpp
	//template väärtuste tablesisse ridade lisamine
	function add ($name, $val)
    {
        //juhul kui sellise nimega elemendi veel ei ole lisatud
        if (!isset($this->vars[$name]))
        {
            $this->set ($name, $val);
        }
        //kui aga sellise nimega element juba olemas, siis
        //lisame lihtsalt juurde veel sama nimega elemendile lisaväärtused
        else
        {
            $this->var[$name]= $this->vars[$name].$val;
        }
    }//add fun lõpp
	function parse()
    {
        $str = $this->content;
        foreach($this->vars as $name=>$val)
        {
            $str = str_replace('{'.$name.'}', $val, $str);
            echo $str.'br/>;
		}
        return $str;
    }
}
//template klassi lõpp



$tmpl = new template ('test');
$tmpl->set('pealkiri', 'test');
$tmpl->set('yks', 'esimene');

?>