<?php
session_start();

if(isset($_SESSION['user'])){
    header('Location: User/');
    // echo 'user';
}
elseif(isset($_SESSION['admin'])){
    header('Location: admin/');
    // echo 'admin';

}
else{

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="index.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital@1&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  <title>CedCab_login</title>
</head>
<body>
<?php include_once './layout/header.php';?>
<div id="div_login">
<div class="login_head">
  <h1>Log IN </h1>
  
</div>
<!-- <h6 id="danger_signup" ></h6> -->
<hr>
<form id="form_login" action="" method="">
<h6 id="err_msg"></h6>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your email" name="email" autocomplete="off">
    
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" autocomplete="off" >
  </div>
  <button type="button" class="btn btn-primary" id="btn_login">Submit</button>

  <p>New User? <a href="signup.php"> Sign Up </a></p>
</form>

</div>









<?php include_once './layout/footer.php';?>
  
</body>
<script>

$("#btn_login").on("click",function(e){
   e.preventDefault();
  let email=$("#email").val();
  let password=$("#password").val();
  if(email!="" && email!=null && email.trim()!=""){
    if(password!="" && password!=null && password.trim()!=""){
      $.ajax({
        type:"post",
        url:"helper.php",
        data:{email:email,password:password,action:"loginverify"},
        success:function(res){
         let jdata=JSON.parse(res);
          if(jdata.status==1){
          
            $("#err_msg").html("Admin successfully Login");
            alert("Admin successfully Login");
            location.replace("./admin/index.php");
          }
          else if(jdata.status==0){
            
            $("#err_msg").html("User successfully Login");
            alert("User successfully Login");
            location.replace("./User/booknew_ride.php");
          }
          else if(jdata.status==-1){
            alert("User Blocked By Admin")
            $("#err_msg").html("User Blocked By Admin");
          }
          else{
            $("#err_msg").html("Your email and password are wrong please check it.");
          }
        },
        error:function(err){
          console.log(arr);
        }
      })
    }
    else{
      $("#err_msg").html("Please enter your password");
    }
  }
  else{
    $("#err_msg").html("Please enter your email");
  }

})


</script>
</html>
<?php }
?>