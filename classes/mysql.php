<?php

//  /classes/mysql.php
class mysql {
    var $conn = false;		//connection-ühendus
    var $host = false;
    var $user = false;
    var $passw = false;
    var $dbname = false;
    //kui leht töötab andmebaasi põhjal vajalik jälgida, millised käsud, mis järjekorras töötavad jne, ja kas päringud kiired
    var $history = array();

    function __construct ($h, $u, $p, $n){
        $this->host = $h;
        $this->user = $u;
        $this->passw = $p;
        $this->dbname = $n;
        $this->connect();
        $this->selectDb();
    }  //konstruktor

    function connect (){		// ühendamine andmebaasiga ja muutujad võtab eelmisest; võib olla sisuga või mitte
        $this->conn = mysqli_connect ($this->host, $this->user, $this->passw, $this->dbname);
        if (mysqli_connect_error()){
            echo 'Viga andmebaasi serveri ühendusega <br/>';
            exit;
        }
    } //connect lopp

    function selectDb(){
        $res = mysqli_select_db($this->conn, $this->dbname);		//kui tahan andmebaasi valida, res = result
        if ($res === false){
            echo 'Ei saanud andmebaasi kätte <br />';
            exit;
        }
    } //select db

    function getMicrotime(){
        list ($usec, $sec) = explode(' ', microtime());
        return ((float)$usec + (float)$sec);
    } //getMicrotime

    function query($sql){			//päringute kiirust ka mõõta siin nüüd microtime = micro sekundid; query kas true või false.. läks päring või mitte
        $begin = $this->getMicrotime();
        $res = mysqli_query ($this->conn, $sql);
        if ($res == false){
            echo 'viga pärinugs! <br/>'.$sql.'<br/>';
            echo mysqli_error ($this->conn).'<br/>';
            exit;
        }
        $time = $this->getMicrotime() - $begin;
        $this->history [] = array ('sql' => $sql, 'time' => $time);
        return $res;
    } //query lopp
    function getArray($sql){
        $res = $this->query($sql);      //mysqli võimaldab juba jooksvalt andmeid vaadata (päringu küsimine võib veel pooleli olla)
        $data = array ();
        while ($record = mysqli_fetch_assoc($res)){
            $data [] = $record;
        }
        if (count ($data) == 0) {         //kui count ei ole null, seal andmed sees
            return false;
        }
        return $data;
    } //getarray lopp
    function showHistory (){
        if (count($this>$this->history) > 0){
            echo '<hr/>';
            foreach ($this->history as $key=>$val){
                echo '<li>'.$val['sql'].'<br/><strong>';
                echo round ($val ['time'], 6).'</strong></li>';
            }
        }
    } //showhis lopp
} //mysql class lõpp
$db = new mysql ('localhost', 'kristelkirsis', 'eifee4ph', 'kristelkirsis_praktikum');
echo '<pre>';
print_r ($db->query('SHOW TABLES'));
print_r ($db->getArray('SELECT * FROM kasutaja1'));
echo '</pre>';
$db = new mysql ('localhost', 'kristelkirsis', 'eifee4ph', 'kristelkirsis_praktikum');
$db->query('SHOW TABLES');
$db->getArray('SELECT * FROM kasutaja1');
$db->showHistory();

?>