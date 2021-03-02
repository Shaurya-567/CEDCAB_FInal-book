<?php
include_once './Class/Dbcon.php';
session_start();
 class User extends Dbcon{
    
  public $user_id;
  public $email_id;
  public $name;
  public $dateofsignup;
  public $status;
  public $mobile;
  public $password;
  public $is_admin;
  public $conn;
  public $sql;
  public $oldpassword;
  public $newpasssword;
  public $userarray=array();
  function __construct()
  {
    $dbcomm=new Dbcon();
    $this->conn=$dbcomm->connect_check();
  }

function checkmail($email){
 $this->sql="select * from tbl_user where email='{$email}';";
 $result = $this->conn->query($this->sql);
 if ($result->num_rows > 0) {
   return 1;
 } 
 return 0;

}


function  logIncheck($email,$password){
  $conpass=md5($password);
  $this->sql="select * from tbl_user where ( email='$email' AND password='$conpass');";
  $result = $this->conn->query($this->sql);
  if ($result->num_rows > 0) {
    while($row=$result->fetch_assoc()){
     if($row['is_admin']==1){
        $_SESSION['admin']['email']=$row['email'];
        $_SESSION['admin']['name']=$row['name'];
        $_SESSION['admin']['mobile']=$row['mobile'];
        $_SESSION['admin']['status']=$row['status'];
        $_SESSION['admin']['user_id']=$row['user_id'];
        $_SESSION['admin']['date']=$row['date'];
        $_SESSION['admin']['password']=$row['password'];
        $_SESSION['admin']['is_admin']=$row['is_admin'];
        $_SESSION['admin']['file']=$row['File'];
         return 1;
     }
     else{
       if($row['status']==1){
        $_SESSION['user']['email']=$row['email'];
        $_SESSION['user']['name']=$row['name'];
        $_SESSION['user']['mobile']=$row['mobile'];
        $_SESSION['user']['status']=$row['status'];
        $_SESSION['user']['user_id']=$row['user_id'];
        $_SESSION['user']['date']=$row['date'];
        $_SESSION['user']['status']=$row['status'];
        $_SESSION['user']['password']=$row['password'];
        $_SESSION['user']['is_admin']=$row['is_admin'];
        $_SESSION['user']['file']=$row['File'];

          return 0;
       }
       else{
         return -1;
       }
     }
    }
    
  } 
}

function Signup_user($name,$email,$mobile,$password,$filename){

  $md5_pass=md5($password);
  
  $this->sql="INSERT INTO `tbl_user` (`user_id`, `email`, `name`, `date`, `mobile`, `status`, `is_admin`, `password`,`File`) VALUES (NULL, '{$email}', '{$name}', now(), '{$mobile}', '1', '0', '{$md5_pass}','{$filename}'); ";
  $result = $this->conn->query($this->sql);

if($result==true){
  
  return 1;
}
else{
  return 0;
}

}
function updateprofile($name,$email,$mobile,$id)
{
   $this->name=$name;
   $this->mobile=$mobile;
   $this->email_id=$email;
   $user_id= $id;
$this->sql="UPDATE `tbl_user` SET `email`='{$this->email_id}', `name` ='{$this->name}',`mobile`='{$this->mobile}' WHERE `user_id` = '{$user_id}'; ";
  
  $result = $this->conn->query($this->sql);


  if($result==true){

    
  return 1;
}
else{
  return 0;
}
}

function checkpassword($oldpassword,$newpassword,$id){
  $this->oldpassword=md5($oldpassword);
  $this->newpassword=md5($newpassword);
    $this->user_id=$id ;
  $this->sql="SELECT  * from tbl_user WHERE `user_id` = '{$this->user_id}' AND `password`='{$this->oldpassword}';";
  $result = $this->conn->query($this->sql);
  if($result == true){

    $sql2="UPDATE `tbl_user` SET `password`='{$this->newpassword}' WHERE `user_id` = '{$this->user_id}'; ";
    $result2 = $this->conn->query($sql2);
    if($result2== true)
    {
      return 1;
    }
    else{
      return 0;
    }
  }
  else{
    return -1;
  }

}
 function showalluseradmintable(){
   $this->sql="Select * from tbl_user where is_admin=0  ORDER BY `email` ASC ;";
   $result = $this->conn->query($this->sql);
   if ($result->num_rows > 0) {
    $j=0;
    while($row=$result->fetch_assoc()){
     $this->userarray[$j]=$row;
     ++$j;
    }
}
return json_encode($this->userarray);


 }
 function blockactiveuser($id,$status){
    $this->user_id=$id;
   if($status==1){
    
    $sql2="UPDATE `tbl_user` SET `status`=0 WHERE `user_id` = '{$this->user_id}'; ";
    $result2 = $this->conn->query($sql2);
    if($result2== true)
    {
      return 1;
    }
    else{
      return 0;
    }
   }
   else if($status==0){
    $sql2="UPDATE `tbl_user` SET `status`=1 WHERE `user_id` = '{$this->user_id}'; ";
    $result2 = $this->conn->query($sql2);
    if($result2== true)
    {
      return 1;
    }
    else{
      return 0;
    }
   }

 }
 function getalluseradmin(){
  $this->sql="SELECT COUNT(*) AS `cc` FROM `tbl_user` WHERE `is_admin`=0  ";
  $result = $this->conn->query($this->sql);
    if ($result->num_rows > 0) {
      while($row=$result->fetch_assoc()){
        return json_encode($row);
      }
  }
}

}



 


?>