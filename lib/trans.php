<?php
//   /lib/trans.php
function tr($txt){
    static $trans = false;

    if (LANG_ID == DEFAULT_LANG){
        return $txt;
    }
    if($trans == false){
        $fn = LANG_DIR.'lang_'.LANG_ID.'.php';
        if(file_exists($fn) and is_file($fn) and is_readable($fn)){
            require_once ($fn);
            $trans = $_trans;
        }
        else {
            $trans = array();
        }
    }
    if (isset($trans[$txt])){
        return $trans[$txt];
    }
    return $txt;
}
?>