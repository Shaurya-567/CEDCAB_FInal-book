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
  <title>CedCab_SignUp</title>
</head>
<body>
  <?php    include_once './layout/header.php'; ?>
<div id="sign_div">
<div id="SING_REG">
   <h1> REGISTRATION FROM</h1>
</div>
<h6 id="danger_signup"></h6>
<hr>
  <form id="form_signup" enctype="multipart/form-data"  >
  <div class="form-group">
    <label for="name">NAME</label>
    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter your name" name="name" autocomplete="off">
    
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your email" name="email" autocomplete="off">
    
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="otp" aria-describedby="emailHelp" placeholder="Enter your otp" name="otp" autocomplete="off">
    
  </div>
  <button type="button" class="btn btn-primary" id="btn_otp">Verify OTP</button>
  <div id="chek_email">
  <div class="form-group">
    <label for="mobile">Mobile</label>
    <input type="text" class="form-control" id="mobile" aria-describedby="emailHelp" placeholder="Enter your mobile number" name="mobile">
    
  </div>
  <label for="file">File Upload</label>
  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text file_upload">Upload</span>
  </div>
  <div class="custom-file">
    <input type="file" class="custom-file-input" id="file" name="file">
    <span class="custom-file-label" for="file">Choose file</span>
  </div>
</div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" placeholder="Enter the Password" name="password">
  </div>
  <div class="form-group">
    <label for="re_password">Re-Enter Password</label>
    <input type="text" class="form-control" id="re_password" placeholder="Re-Enter the Password" name="re_password">
  </div>
  
  <button type="submit" class="btn btn-primary" id="btn_signup">Submit</button>
  <p>Already Registred ? <a href="login.php"> Log IN</a></p>
</form>
</div>
</div>
  <?php  include_once './layout/footer.php';?>
</body>
<script>
$("#form_signup").on("submit",function(e){
  e.preventDefault();
  let name =$("#name").val();
  let email=$("#email").val();
  let mobile=$("#mobile").val();
  let password=$("#password").val();
   let re_password=$("#re_password").val();
   

  if(name!="" && name.trim()!=" ")
  {
    if(email!="" && email.trim()!=" "){
      if(mobile!="" && mobile.trim()!=" "){
        if(password!="" && password.trim()!=" "){
           
          if(re_password!="" && re_password.trim()!=" "){
            
            if(password == re_password)
            {
              let property=document.getElementById("file").files[0];

             var image_name = property.name;
              var image_extension = image_name.split('.').pop().toLowerCase();

             if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png']) == -1){

               alert("Invalid image file");
               $("#danger_signup").html("Invalid File Format");
                }
        else{
              let formData=new FormData(this);
              formData.append("action","signup");
              $("#danger_signup").html("");
             
              // debugger;
              $.ajax({
                type:"post",
                url:"helper.php",
                contentType:false,
                processData:false,
                data: formData,
                success:function(res){
                  let jdata=JSON.parse(res);
                
                  if(jdata.status==1){
                    $("#danger_signup").html("Congratulation ! You have Successfully create Account");
                    alert("Congratulation ! You have Successfully create Account");
                  location.replace("login.php");
                  }
                  else{
                    $("#danger_signup").html("SomeThink went wrong.Please chck your above detail.");
                  }

                },error:function(err){
                  alert(err);
                }

                
              })

            }
          }
            else{
              $("#danger_signup").html("Your Password did not match! Please enter valid password and Re-Enter Password.");
            }
          }
          else{
            $("#danger_signup").html("Please enter  your Re-Enter password");
          }
        }
        else{
          $("#danger_signup").html("Please enter your password");
        }

    }
    
    else{
      $("#danger_signup").html("Please enter your vaild mobile");
    }
  }
  else{
      $("#danger_signup").html("Please enter your email");
    }
  }
  else{
    $("#danger_signup").html("Please enter your name");
  }


})

$("#email").on("change",function(){

  let email=$("#email").val();
  $("#mobile").prop('disabled', true);
          $("#password").prop('disabled', true);
          $("#re_password").prop('disabled', true);
          $("#btn_signup").prop('disabled', true);
          $("#file").prop('disabled', true);
  if(email!="" && email.trim()!=" "){
  $.ajax({
      type:"post",
      url:"helper.php",
      data:{email:email,action: "verifyemail"},
      success:function(res){
        if(res==1){
          $("#name").prop('disabled', true);
          


          $("#danger_signup").html("Email already exist!");
        }
        else{
           $("#danger_signup").html("Otp Send Successfully");
          $("#otp").show();
          $("#btn_otp").css("display","block");
          
        }

      }

  })
}
else {
  $("#danger_signup").html("Please enter your email");
}
})

$("#btn_otp").on("click",function(){

let otp=$("#otp").val();
$.ajax({
  type:"post",
  url:"helper.php",
  data:{otp: otp, action: "otpverigfyinp"},
  success:function(res){

 let jdata= JSON.parse(res);

 let status=jdata.status;
 if(status == 1){
  $("#otp").hide();
          $("#btn_otp").css("display","none");
          $("#mobile").prop('disabled', false);
          $("#password").prop('disabled', false);
          $("#re_password").prop('disabled', false);
          $("#btn_signup").prop('disabled', false);
          $("#file").prop('disabled', false);
          $("#danger_signup").html("Otp Verify Successfully");

 }
 else{
  $("#otp").hide();
  $("#btn_otp").css("display","none");
  $("#danger_signup").html("Otp Verify Failed");
 }
  }
})

})



$("#file").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });

</script>
</html>
<?php } ?>