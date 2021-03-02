<?php

class Dbcon{
  public $hostname;
 public $username;
 public $password;
 public $dbname;
 public $conn;

 function __construct($hostname="localhost",$username="root",$password="",$dbname="cedcab"){
   $this->hostname=$hostname;
   $this->username=$username;
   $this->password=$password;
   $this->dbname=$dbname;

   

 }
 function connect_check(){
   $this->conn= new mysqli($this->hostname,$this->username,$this->password,$this->dbname);
   return $this->conn;
 }






}





?>