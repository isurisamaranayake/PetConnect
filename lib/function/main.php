<?php
include_once('db_conn.php');
//create main class
class Main{
    public function __construct(){
        $this->connObj = new Connection("localhost","root","","db_pet_d");

        $this->dbResult = $this->connObj->Conn();
        
        return($this->dbResult);
    }
}
?>