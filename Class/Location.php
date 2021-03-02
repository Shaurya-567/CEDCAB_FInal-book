<?php 
 
 include_once 'Dbcon.php';
 class Location extends Dbcon{
     public $id;
     public $name;
     public $distance;
     public $is_available;
     public $pure_conn;
     public $sql;
     public $arrname=array();


  function __construct()
  {
      $conn=new Dbcon();
      $this->pure_conn=$conn->connect_check();
    
  }

  function getalllocationdeatail(){
    $this->sql="SELECT * FROM `tbl_location` WHERE 1";
    $result = $this->pure_conn->query($this->sql);
    $row=$result->num_rows;
    //  print $row;
    if($row>0){
      $i=0;
       while($row=$result->fetch_assoc()){
       $this->arrname[$i]=$row;
       ++$i;
    }
  }
 

  return json_encode($this->arrname);
  }

   
  function newloactionaddadmin($los,$dis){

    $this->sql="INSERT INTO `tbl_location`(`id`,`name`,`distance`,`is_available`) VALUES (NULL,'{$los}','{$dis}',1);";
    $result = $this->pure_conn->query($this->sql);
    if($result ==true){
      return 1;
    }
    else{
      return 0;
    }
  
  }
   function all_location(){
     $this->sql="SELECT * FROM `tbl_location` WHERE is_available=1";
     $result = $this->pure_conn->query($this->sql);
     $row=$result->num_rows;
    //  print $row;
    if($row>0){
      $i=0;
       while($row=$result->fetch_assoc()){
       $this->arrname[$i]=$row;
       ++$i;
    }
  }
 

  return $this->arrname;

 }

 function countalllocation(){
  $this->sql="SELECT COUNT(name) FROM `tbl_location` WHERE 1 ";
  $result = $this->pure_conn->query($this->sql);
    if ($result->num_rows > 0) {
      while($row=$result->fetch_assoc()){
        return json_encode($row);
      }
  }
}
function gettotaldistanceadmin()
{
  $this->sql="SELECT sum(distance) FROM `tbl_location` WHERE is_available=1";
  $result = $this->pure_conn->query($this->sql);
    if ($result->num_rows > 0) {
      while($row=$result->fetch_assoc()){
        return json_encode($row);
      }
  }
}
function activeblocklocation($id,$available){
  if($available ==1){
    $this->sql="UPDATE `tbl_location` SET `is_available` = 0 WHERE `tbl_location`.`id` = '{$id}'; ";
    $result = $this->pure_conn->query($this->sql);
    if($result ==true){
      return 1;
    }
    else{
      return 0;
    }

  }
  else if($available==0){
    $this->sql="UPDATE `tbl_location` SET `is_available` = 1 WHERE `tbl_location`.`id` = '{$id}'; ";
    $result = $this->pure_conn->query($this->sql);
    if($result ==true){
      return 1;
    }
    else{
      return 0;
    }
  }

}


function updatelocationadmin($locationname,$distance,$is_available,$id){

  $this->sql="UPDATE `tbl_location` SET `is_available` = '{$is_available}', `name` ='{$locationname}',`distance`='{$distance}' WHERE `tbl_location`.`id` = '{$id}'; ";
  // echo $this->sql;
    $result = $this->pure_conn->query($this->sql);
    if($result ==true){
      return 1;
    }
    else{
      return 0;
    }
  }


 
function alllocationforedit($id){
  $this->sql="SELECT * from `tbl_location` WHERE `id`='{$id}';";
  $result = $this->pure_conn->query($this->sql);
    if ($result->num_rows > 0) {
      while($row=$result->fetch_assoc()){
        return json_encode($row);
      }
  }
}
 }



?>