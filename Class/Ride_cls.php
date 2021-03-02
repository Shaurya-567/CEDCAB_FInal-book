<?php
session_start();
include_once './Class/Dbcon.php';

class Ride extends Dbcon
{
  public $sql;
  public $pick;
  public $drop;
  public $distance;
  public $cab_type;
  public $luggage;
  public $total_fare;
  public $user_id;
  public $pickname;
  public $dropname;
  public $ridearray=array();
  public $ridearray2=array();
  public $newarray=array();


  function __construct()
  {
    $dbcomm=new Dbcon();
    $this->conn=$dbcomm->connect_check();
  }
  public function cal_fare_cab($dist, $cab_name, $lauggage=0,$pick,$drop,$pickname,$dropname)
  {
      $this->pick=$pick;
      $this->drop=$drop;
      $this->cab_type=$cab_name;
      $this->pickname=$pickname;
      $this->dropname=$dropname;

    switch ( $this->cab_type) {


     // ************* Check CedMicro Fare *************
      case "CedMicro":
        if ($dist > 0 && $dist <= 10) {
          $price = $dist * 13.50;
        } else if ($dist > 10 && $dist <= 60) {
          $temp = 10 * 13.50;
          $price = (($dist - 10) * 12.00) + $temp;
        } else if ($dist > 60 && $dist <= 160) {
          $temp1 = 10 * 13.50;
          $temp2 = 50 * 12.00;
          $price = (($dist - 60) * 10.20) + ($temp1 + $temp2);
        } else
         {
          $temp1 = 10 * 13.50;
          $temp2 = 50 * 12.00;
          $temp3 = 100 * 10.20;
          $price = (($dist - 160) * 8.50) + ($temp1 + $temp2+$temp3);
        }
        $tot_price=$price+50;
        $this->total_fare=$tot_price;
        // return $this->total_fare;
        break;


         // ************* Check CedMini Fare *************

        case "CedMini":
          if ($dist > 0 && $dist <= 10) {
            $price = $dist * 14.50;
          } 
          else if ($dist > 10 && $dist <= 60) {
            $temp = 10 * 14.50;
            $price = (($dist - 10) * 13.00) + $temp;
          } 
          else if ($dist > 60 && $dist <= 160) {
            $temp1 = 10 * 14.50;
            $temp2 = 50 * 13.00;
            $price = (($dist - 60) * 11.20) + ($temp1 + $temp2);
          } 
          else
           {
            $temp1 = 10 * 14.50;
            $temp2 = 50 * 13.00;
            $temp3 = 100 * 11.20;
            $price = (($dist - 160) * 9.50) + ($temp1 + $temp2+$temp3);
          }
          if($lauggage ==null && $lauggage==0)
          {
            $price+=0;
          }
          else if($lauggage>0 && $lauggage<=10){
            $price+=50;
          }
          else if($lauggage>10 && $lauggage<=20){
            $price+=100;
          }
          else if($lauggage>20){
            $price+=200;
          }

          $tot_price=$price+150;
          $this->total_fare=$tot_price;
          break;

             // ************* Check CedRoyal Fare *************


          case "CedRoyal":
            if ($dist > 0 && $dist <= 10) {
              $price = $dist * 15.50;
            } 
            else if ($dist > 10 && $dist <= 60) {
              $temp = 10 * 15.50;
              $price = (($dist - 10) * 14.00) + $temp;
            } 
            else if ($dist > 60 && $dist <= 160) {
              $temp1 = 10 * 15.50;
              $temp2 = 50 * 14.00;
              $price = (($dist - 60) * 12.20) + ($temp1 + $temp2);
            } 
            else
             {
              $temp1 = 10 * 15.50;
              $temp2 = 50 * 14.00;
              $temp3 = 100 * 12.20;
              $price = (($dist - 160) * 10.50) + ($temp1 + $temp2+$temp3);
            }
            if($lauggage ==null && $lauggage==0)
          {
            $price+=0;
          }
           else if($lauggage>0 && $lauggage<=10){
              $price+=50;
            }
            else if($lauggage>10 && $lauggage<=20){
              $price+=100;
            }
            else if($lauggage>20){
              $price+=200;
            }
  
            $tot_price=$price+200;
            $this->total_fare=$tot_price;
            break;


             // ************* Check CedSUV Fare *************


          case "CedSUV":
            if ($dist > 0 && $dist <= 10) {
              $price = $dist * 16.50;
            } 
            else if ($dist > 10 && $dist <= 60) {
              $temp = 10 * 16.50;
              $price = (($dist - 10) * 15.00) + $temp;
            } 
            else if ($dist > 60 && $dist <= 160) {
              $temp1 = 10 * 16.50;
              $temp2 = 50 * 15.00;
              $price = (($dist - 60) * 13.20) + ($temp1 + $temp2);
            } 
            else
             {
              $temp1 = 10 * 16.50;
              $temp2 = 50 * 15.00;
              $temp3 = 100 * 13.20;
              $price = (($dist - 160) * 11.50) + ($temp1 + $temp2+$temp3);
            }
            if($lauggage ==null && $lauggage==0)
          {
            $price+=0;
          }
            else if($lauggage>0 && $lauggage<=10){
              $price+=100;
            }
            else if($lauggage>10 && $lauggage<=20){
              $price+=200;
            }
            else if($lauggage>20){
              $price+=400;
            }
  
            $tot_price=$price+250;
            $this->total_fare=$tot_price;
            break;
            default:
             
            return 0;

    }
    $_SESSION['ride']['pickup_name']= $this->pickname;
    $_SESSION['ride']['drop_name']= $this->dropname;
    $_SESSION['ride']['pickup']=$this->pick;
    $_SESSION['ride']['drop']=$this->drop;
    $_SESSION['ride']['cab_name']=$this->cab_type;
     $_SESSION['ride']['distance']=$dist;
     $_SESSION['ride']['luggage']=$lauggage;
     $_SESSION['ride']['total_fare']=$this->total_fare;
     $_SESSION['start'] = time();
     $_SESSION['expire'] = $_SESSION['start'] + (1*60);
return $this->total_fare;
  }

  function insertnewride(){
          
           $this->user_id=$_SESSION['user']['user_id'];
           $this->pick= $_SESSION['ride']['pickup'];
           $this->drop=$_SESSION['ride']['drop'];
           $this->cab_type= $_SESSION['ride']['cab_name'];
           $this->distance= $_SESSION['ride']['distance'];
           $this->luggage= $_SESSION['ride']['luggage'];
           $this->total_fare=$_SESSION['ride']['total_fare'];

    $this->sql="INSERT INTO `tbl_ride`( `ride_date`, `pickup`, `todrop`, `total_distance`, `luggage`, `total_fare`, `status`, `user_id`, `cab_type`) VALUES (now(),'{$this->pick}','{$this->drop}','{$this->distance}','{$this->luggage}','{$this->total_fare}',1,'{$this->user_id}','{$this->cab_type}');";
    $result = $this->conn->query($this->sql);
    if($result==true){
      return 1;
    }
    else{
      return 0;
    }
  }


  function showridedetail(){

    $this->userid=$_SESSION['user']['user_id'];
    $this->sql="select * from tbl_ride INNER JOIN tbl_location ON tbl_ride.pickup = tbl_location.id WHERE user_id='{$this->userid}';";
    $sql2="select * from tbl_ride INNER JOIN tbl_location ON tbl_ride.todrop = tbl_location.id WHERE user_id='{$this->userid}';";
    $result = $this->conn->query($this->sql);
    $result2= $this->conn->query($sql2);
    if ($result->num_rows > 0) {
      $i=0;
      while($row=$result->fetch_assoc()){
        
       $this->ridearray[$i]=$row;
       ++$i;
  }
}
if ($result2->num_rows > 0) {
  $i=0;
  while($row2=$result2->fetch_assoc()){
    
   $this->ridearray2[$i]=$row2;
   ++$i;
}
}
return json_encode(array("array1"=>$this->ridearray,"array2"=>$this->ridearray2));
  }


  function cancelride(){
    $this->userid=$_SESSION['user']['user_id'];
    $this->sql="select count(ride_id) from tbl_ride  WHERE user_id='{$this->userid}' AND status= 0;";
    $result = $this->conn->query($this->sql);
    if ($result->num_rows > 0) {
      while($row=$result->fetch_assoc()){
        return json_encode($row);
      }
  }

}
function pendingride(){
  $this->userid=$_SESSION['user']['user_id'];
    $this->sql="select count(ride_id) from tbl_ride  WHERE user_id='{$this->userid}' AND status= 1;";
    $result = $this->conn->query($this->sql);
    if ($result->num_rows > 0) {
      while($row=$result->fetch_assoc()){
        return json_encode($row);
      }
  }
}
function allrides(){
  $this->userid=$_SESSION['user']['user_id'];
    $this->sql="select count(ride_id) from tbl_ride  WHERE user_id='{$this->userid}';";
    $result = $this->conn->query($this->sql);
    if ($result->num_rows > 0) {
      while($row=$result->fetch_assoc()){
        return json_encode($row);
      }
  }
}
function totalfare(){
  $this->userid=$_SESSION['user']['user_id'];
  $this->sql="select SUM(total_fare) from tbl_ride  WHERE (user_id='{$this->userid}' AND status=2);";
  $result = $this->conn->query($this->sql);
  if ($result->num_rows > 0) {
    while($row=$result->fetch_assoc()){
      return json_encode($row);
    }
}

}
 function allcompleteride()
{
  $this->userid=$_SESSION['user']['user_id'];
  $this->sql="select * from tbl_ride INNER JOIN tbl_location ON tbl_ride.pickup = tbl_location.id WHERE (user_id='{$this->userid}' AND status=2);";
  $sql2="select * from tbl_ride INNER JOIN tbl_location ON tbl_ride.todrop = tbl_location.id WHERE (user_id='{$this->userid}' AND status=2);";
  $result = $this->conn->query($this->sql);
  $result2= $this->conn->query($sql2);
  if ($result->num_rows > 0) {
    $i=0;
    while($row=$result->fetch_assoc()){
      
     $this->ridearray[$i]=$row;
     ++$i;
}
}
if ($result2->num_rows > 0) {
$i=0;
while($row2=$result2->fetch_assoc()){
  
 $this->ridearray2[$i]=$row2;
 ++$i;
}
}
return json_encode(array("array1"=>$this->ridearray,"array2"=>$this->ridearray2));

}

function allcancelride()
{
  $this->userid=$_SESSION['user']['user_id'];
  $this->sql="select * from tbl_ride INNER JOIN tbl_location ON tbl_ride.pickup = tbl_location.id WHERE (user_id='{$this->userid}' AND status=0);";
  $sql2="select * from tbl_ride INNER JOIN tbl_location ON tbl_ride.todrop = tbl_location.id WHERE (user_id='{$this->userid}' AND status=0);";
  $result = $this->conn->query($this->sql);
  $result2= $this->conn->query($sql2);
  if ($result->num_rows > 0) {
    $i=0;
    while($row=$result->fetch_assoc()){
      
     $this->ridearray[$i]=$row;
     ++$i;
}
}
if ($result2->num_rows > 0) {
$i=0;
while($row2=$result2->fetch_assoc()){
  
 $this->ridearray2[$i]=$row2;
 ++$i;
}
}
return json_encode(array("array1"=>$this->ridearray,"array2"=>$this->ridearray2));

}

function ridecancel($delet){
               
  $this->sql="UPDATE `tbl_ride` SET  `status` = 0 WHERE `tbl_ride`.`ride_id` = '{$delet}'; ";
  $result = $this->conn->query($this->sql);
  if($result ==true){
    return 1;
  }
  else{
    return 0;
  }
}



function ridebookadmin($delet){
               
  $this->sql="UPDATE `tbl_ride` SET  `status` = 2 WHERE `tbl_ride`.`ride_id` = '{$delet}'; ";
  $result = $this->conn->query($this->sql);
  if($result ==true){
    return 1;
  }
  else{
    return 0;
  }
}


function viewdetail($ride_id){

  $this->sql="SELECT b.`name` as `pickup`,user.`name` as `name`, c.`name` as `drop`,a.`ride_date`,a.`user_id`,a.`total_distance` ,a.`ride_id`,a.`luggage` ,a.`total_fare` ,a.cab_type as cab , a.`status` from `tbl_ride` as a JOIN `tbl_location` as b ON a.`pickup` = b.`id` JOIN `tbl_location` as c ON a.`todrop` = c.`id` JOIN `tbl_user` as user ON a.`user_id`= user.`user_id`  WHERE a.`ride_id` = '{$ride_id}'; ";

  $result = $this->conn->query($this->sql); 
  if ($result->num_rows > 0) {
    $i=0;
    while($row=$result->fetch_assoc()){
      
     $this->ridearray[$i]=$row;
     ++$i;
}
  }
  return json_encode( $this->ridearray);
}
function countallpendingrideadmin(){
  $this->sql="SELECT count(ride_id) FROM `tbl_ride` WHERE status=1 ;";
  $result = $this->conn->query($this->sql);
    if ($result->num_rows > 0) {
      while($row=$result->fetch_assoc()){
        return json_encode($row);
      }
  }
}

function countallrideadmin(){
  $this->sql="SELECT count(ride_id) FROM `tbl_ride` WHERE 1 ;";
  $result = $this->conn->query($this->sql);
    if ($result->num_rows > 0) {
      while($row=$result->fetch_assoc()){
        return json_encode($row);
      }
  }
}

function getcountallcompleteride(){
  $this->sql="SELECT COUNT(ride_id) FROM `tbl_ride` WHERE status=2 ;";
  $result = $this->conn->query($this->sql);
    if ($result->num_rows > 0) {
      while($row=$result->fetch_assoc()){
        return json_encode($row);
      }
  }
}
function getcountallcancelride(){
  $this->sql="SELECT COUNT(ride_id) FROM `tbl_ride` WHERE status=0 ;";
  $result = $this->conn->query($this->sql);
    if ($result->num_rows > 0) {
      while($row=$result->fetch_assoc()){
        return json_encode($row);
      }
  }
}

function getallearnadmin(){
  $this->sql="SELECT sum(total_fare) FROM `tbl_ride` WHERE status=2  ";
  $result = $this->conn->query($this->sql);
    if ($result->num_rows > 0) {
      while($row=$result->fetch_assoc()){
        return json_encode($row);
      }
  }
}
function showpendingrideadmin(){
  $this->sql="SELECT b.`name` as `pickup`,user.`name` as `name` ,c.`name` as `drop`,a.`ride_date` ,a.`total_distance` ,a.`ride_id`,a.`luggage` ,a.`total_fare` ,a.cab_type as cab , a.`status` from `tbl_ride` as a JOIN `tbl_location` as b ON a.`pickup` = b.`id` JOIN `tbl_location` as c ON a.`todrop` = c.`id` JOIN `tbl_user` as user ON a.`user_id`= user.`user_id` WHERE a.`status` =1 ;";
  $result = $this->conn->query($this->sql);
    if ($result->num_rows > 0) {
      $j=0;
      while($row=$result->fetch_assoc()){
       $this->ridearray[$j]=$row;
       ++$j;
      }
  }
  return json_encode($this->ridearray);
}

function showcompletdrideadmin(){
  $this->sql="SELECT b.`name` as `pickup`,user.`name` as `name` , c.`name` as `drop`,a.`ride_date` ,a.`total_distance` ,a.`ride_id`,a.`luggage` ,a.`total_fare` ,a.cab_type as cab , a.`status` from `tbl_ride` as a JOIN `tbl_location` as b ON a.`pickup` = b.`id` JOIN `tbl_location` as c ON a.`todrop` = c.`id` JOIN `tbl_user` as user ON a.`user_id`= user.`user_id` WHERE a.`status` =2;";
  $result = $this->conn->query($this->sql);
    if ($result->num_rows > 0) {
      $j=0;
      while($row=$result->fetch_assoc()){
       $this->ridearray[$j]=$row;
       ++$j;
      }
  }
  return json_encode($this->ridearray);
}


function showcancelrideadmin(){
  $this->sql="SELECT b.`name` as `pickup`, c.`name` as `drop`,user.`name` as `name` ,a.`ride_date` ,a.`total_distance` ,a.`ride_id`,a.`luggage` ,a.`total_fare` ,a.cab_type as cab , a.`status` from `tbl_ride` as a JOIN `tbl_location` as b ON a.`pickup` = b.`id` JOIN `tbl_location` as c ON a.`todrop` = c.`id` JOIN `tbl_user` as user ON a.`user_id`= user.`user_id`  WHERE a.`status` =0 ;";
  $result = $this->conn->query($this->sql);
    if ($result->num_rows > 0) {
      $j=0;
      while($row=$result->fetch_assoc()){
       $this->ridearray[$j]=$row;
       ++$j;
      }
  }
  return json_encode($this->ridearray);
}

function showallrideadmintable(){
  $this->sql="SELECT b.`name` as `pickup`, c.`name` as `drop`,a.`ride_date` ,user.`name` as `name` , a.`total_distance` ,a.`ride_id`,a.`luggage` ,a.`total_fare` ,a.cab_type as cab , a.`status` from `tbl_ride` as a JOIN `tbl_location` as b ON a.`pickup` = b.`id` JOIN `tbl_location` as c ON a.`todrop` = c.`id` JOIN `tbl_user` as user ON a.`user_id`= user.`user_id` WHERE 1";
  $result = $this->conn->query($this->sql);
    if ($result->num_rows > 0) {
      $j=0;
      while($row=$result->fetch_assoc()){
       $this->ridearray[$j]=$row;
       ++$j;
      }
  }
  return json_encode($this->ridearray);
}

function ascfarecancel($id){
  $this->sql="SELECT b.`name` as `pickup`, c.`name` as `drop`,a.`ride_date` ,user.`name` as `name` , a.`total_distance` ,a.`ride_id`,a.`luggage` ,a.`total_fare` ,a.cab_type as cab , a.`status` from `tbl_ride` as a JOIN `tbl_location` as b ON a.`pickup` = b.`id` JOIN `tbl_location` as c ON a.`todrop` = c.`id` JOIN `tbl_user` as user ON a.`user_id`= user.`user_id` WHERE a.user_id='{$id}' ORDER BY `total_fare` Asc ";
  $result = $this->conn->query($this->sql);
  if ($result->num_rows > 0) {
    $j=0;
    while($row=$result->fetch_assoc()){
     $this->ridearray[$j]=$row;
     ++$j;
    }
}
return json_encode($this->ridearray);

}
function descfarecancel($id){
  $this->sql="SELECT b.`name` as `pickup`, c.`name` as `drop`,a.`ride_date` ,user.`name` as `name` , a.`total_distance` ,a.`ride_id`,a.`luggage` ,a.`total_fare` ,a.cab_type as cab , a.`status` from `tbl_ride` as a JOIN `tbl_location` as b ON a.`pickup` = b.`id` JOIN `tbl_location` as c ON a.`todrop` = c.`id` JOIN `tbl_user` as user ON a.`user_id`= user.`user_id` WHERE a.user_id='{$id}' ORDER BY `total_fare` DESC ";
  $result = $this->conn->query($this->sql);
  if ($result->num_rows > 0) {
    $j=0;
    while($row=$result->fetch_assoc()){
     $this->ridearray[$j]=$row;
     ++$j;
    }
}
return json_encode($this->ridearray);

}
function ascdatecancel($id){
  $this->sql="SELECT b.`name` as `pickup`, c.`name` as `drop`,a.`ride_date` ,user.`name` as `name` , a.`total_distance` ,a.`ride_id`,a.`luggage` ,a.`total_fare` ,a.cab_type as cab , a.`status` from `tbl_ride` as a JOIN `tbl_location` as b ON a.`pickup` = b.`id` JOIN `tbl_location` as c ON a.`todrop` = c.`id` JOIN `tbl_user` as user ON a.`user_id`= user.`user_id` WHERE a.user_id='{$id}' ORDER BY `cab_type` ASC ";
  $result = $this->conn->query($this->sql);
  if ($result->num_rows > 0) {
    $j=0;
    while($row=$result->fetch_assoc()){
     $this->ridearray[$j]=$row;
     ++$j;
    }
}
return json_encode($this->ridearray);

}

function descdatecancel($id){
  $this->sql="SELECT b.`name` as `pickup`, c.`name` as `drop`,a.`ride_date` ,user.`name` as `name` , a.`total_distance` ,a.`ride_id`,a.`luggage` ,a.`total_fare` ,a.cab_type as cab , a.`status` from `tbl_ride` as a JOIN `tbl_location` as b ON a.`pickup` = b.`id` JOIN `tbl_location` as c ON a.`todrop` = c.`id` JOIN `tbl_user` as user ON a.`user_id`= user.`user_id` WHERE a.user_id='{$id}' ORDER BY `cab_type` DESC ";
  $result = $this->conn->query($this->sql);
  if ($result->num_rows > 0) {
    $j=0;
    while($row=$result->fetch_assoc()){
     $this->ridearray[$j]=$row;
     ++$j;
    }
}
return json_encode($this->ridearray);

}

function ascfarecanceladmin(){
  $this->sql="SELECT b.`name` as `pickup`, c.`name` as `drop`,a.`ride_date` ,user.`name` as `name` , a.`total_distance` ,a.`ride_id`,a.`luggage` ,a.`total_fare` ,a.cab_type as cab , a.`status` from `tbl_ride` as a JOIN `tbl_location` as b ON a.`pickup` = b.`id` JOIN `tbl_location` as c ON a.`todrop` = c.`id` JOIN `tbl_user` as user ON a.`user_id`= user.`user_id` ORDER BY `total_fare` Asc ";
  $result = $this->conn->query($this->sql);
  if ($result->num_rows > 0) {
    $j=0;
    while($row=$result->fetch_assoc()){
     $this->ridearray[$j]=$row;
     ++$j;
    }
}
return json_encode($this->ridearray);

}
function descfarecanceladmin(){
  $this->sql="SELECT b.`name` as `pickup`, c.`name` as `drop`,a.`ride_date` ,user.`name` as `name` , a.`total_distance` ,a.`ride_id`,a.`luggage` ,a.`total_fare` ,a.cab_type as cab , a.`status` from `tbl_ride` as a JOIN `tbl_location` as b ON a.`pickup` = b.`id` JOIN `tbl_location` as c ON a.`todrop` = c.`id` JOIN `tbl_user` as user ON a.`user_id`= user.`user_id`  ORDER BY `total_fare` DESC ";
  $result = $this->conn->query($this->sql);
  if ($result->num_rows > 0) {
    $j=0;
    while($row=$result->fetch_assoc()){
     $this->ridearray[$j]=$row;
     ++$j;
    }
}
return json_encode($this->ridearray);

}

function desccabtypecanceladmin(){
  $this->sql="SELECT b.`name` as `pickup`, c.`name` as `drop`,a.`ride_date` ,user.`name` as `name` , a.`total_distance` ,a.`ride_id`,a.`luggage` ,a.`total_fare` ,a.cab_type as cab , a.`status` from `tbl_ride` as a JOIN `tbl_location` as b ON a.`pickup` = b.`id` JOIN `tbl_location` as c ON a.`todrop` = c.`id` JOIN `tbl_user` as user ON a.`user_id`= user.`user_id` ORDER BY `cab_type` DESC ";
  $result = $this->conn->query($this->sql);
  if ($result->num_rows > 0) {
    $j=0;
    while($row=$result->fetch_assoc()){
     $this->ridearray[$j]=$row;
     ++$j;
    }
}
return json_encode($this->ridearray);

}
function asccabtypecanceladmin(){
  $this->sql="SELECT b.`name` as `pickup`, c.`name` as `drop`,a.`ride_date` ,user.`name` as `name` , a.`total_distance` ,a.`ride_id`,a.`luggage` ,a.`total_fare` ,a.cab_type as cab , a.`status` from `tbl_ride` as a JOIN `tbl_location` as b ON a.`pickup` = b.`id` JOIN `tbl_location` as c ON a.`todrop` = c.`id` JOIN `tbl_user` as user ON a.`user_id`= user.`user_id`ORDER BY `cab_type` ASC ";
  $result = $this->conn->query($this->sql);
  if ($result->num_rows > 0) {
    $j=0;
    while($row=$result->fetch_assoc()){
     $this->ridearray[$j]=$row;
     ++$j;
    }
}
return json_encode($this->ridearray);

}
}
// AND tbl_ride.todrop= tbl_location.id