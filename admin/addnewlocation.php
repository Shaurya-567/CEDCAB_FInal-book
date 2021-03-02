<?php
session_start();

// print_r($_SESSION);
if (!isset($_SESSION['admin']) ||  $_SESSION['admin']['is_admin'] != 1) {
  die("Direct Access Not allowed");
} else {

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../index.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital@1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title><?php echo $_SESSION['admin']['name'] . " Book _Cab"; ?></title>
  </head>

  <body>
    <?php include_once '../admin/layout/header.php'; ?>

    <div id="sign_div">
      <div id="SING_REG">
        <h1>Add New Location</h1>
      </div>
      <h6 id="danger_signup"></h6>
      <hr>
      <form id="form_signup" enctype="multipart/form-data">
        <div class="form-group">
          <label for="password">New Location</label>
          <input type="text" class="form-control" id="locationname" aria-describedby="emailHelp" placeholder="Enter your new location" name="locationname" autocomplete="off">

        </div>
        <div class="form-group">
          <label for="newpassword">Distance</label>
          <input type="number" class="form-control" id="distance" aria-describedby="emailHelp" placeholder="Enter your new location distance" name="distance" autocomplete="off">

        </div>
        <button type="button" class="btn btn-primary" id="btn_insertlocation">Insert Location</button>

      </form>
    </div>
    </div>

    <?php include_once '../admin/layout/footer.php'; ?>
  </body>
   <script>
   $("#btn_insertlocation").on("click",function(){
     let locationname=$("#locationname").val();
     let distance=$("#distance").val();
  
     if(locationname!="" && locationname.trim()!=" "){
       if(distance!="" && distance.trim()!=" " ){

          $("#danger_signup").text("");
            $.ajax({
              type:"post",
              url:"../helper.php",
              data:{
                action:"addnewlocationadmin",
                loc:locationname,
                dis:distance
              },
              success:function(res){
          
                 if(res==1){
                   alert("New Location are Add ");
                   location.replace("./index.php");
                 }
                 else{
                   alert("Somethink went Wrong! Did not add location");
                 }
              },
              error:function(err){
                alert("Something went wrong"+err)
              }
            })

         
        


       }
       else{
        $("#danger_signup").text("Please Enter the proper Location Distance");

       }

     }
     else{
       $("#danger_signup").text("Please Enter the proper Location");

     }
   })

  </script>

</html>

<?php
} ?>