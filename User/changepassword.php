<?php
session_start();

// print_r($_SESSION);
if (!isset($_SESSION['user']) ||  $_SESSION['user']['is_admin'] != 0) {
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title><?php echo $_SESSION['user']['name'] . "Book _Cab"; ?></title>
  </head>

  <body>
    <?php include_once './layout/header.php' ?>

    <div id="sign_div">
      <div id="SING_REG">
        <h1>UPADTE PASSWORD</h1>
      </div>
      <h6 id="danger_signup"></h6>
      <hr>
      <form id="form_signup" enctype="multipart/form-data">
        <div class="form-group">
          <label for="password">Old Password</label>
          <input type="password" class="form-control" id="oldpassword" aria-describedby="emailHelp" placeholder="Enter your old password" name="oldpassword" autocomplete="off">

        </div>
        <div class="form-group">
          <label for="newpassword">New Password</label>
          <input type="password" class="form-control" id="newpassword" aria-describedby="emailHelp" placeholder="Enter your new password" name="newpassword" autocomplete="off">

        </div>
        <div class="form-group">
          <label for="confirmpassword">Confirm Password</label>
          <input type="text" class="form-control" id="confirmpassword" aria-describedby="emailHelp" placeholder="Enter your confirm password" name="confirmpassword" autocomplete="off">

        </div>



        <button type="button" class="btn btn-primary" id="btn_passwordupdate">Update Password</button>

      </form>
    </div>
    </div>



    <?php include_once './layout/footer.php' ?>

  </body>
  <script>
    $("#btn_passwordupdate").on("click", function() {
      let newpassword = $("#newpassword").val();
      let confrimpassword = $("#confirmpassword").val();
      let oldpassword = $("#oldpassword").val();
      if (oldpassword !="" && oldpassword.trim()!= " ")
       {
        if (newpassword!="" && newpassword.trim()!= " ") 
        {
          if (confrimpassword!="" && confrimpassword.trim()!= " ")
           {
            if (confrimpassword == newpassword) 
            {
              $("#danger_signup").html("");
              let input = {
                newpassword: newpassword,
                oldpassword: oldpassword,
                action: "changepassword"
              }
              $.ajax({
                type: "post",
                url: "../helper.php",
                data: input,
                success: function(result) {
                  if (result == 1) {
                    $("#danger_signup").html("Congratulation ,You password has been changed.");
                    alert("Congratulation ,You password has been changed.");
                    window.location.replace("index.php");
                  }
                },
                error: function(err) {
                  alert("Something went Wrong!");
                }

              })
            } else {
              $("#danger_signup").html("Confirm Password Did not matched !");
            }
          } else {
            $("#danger_signup").html("Please enter the valid confirm password !");
          }
        } else {
          $("#danger_signup").html("Please enter the valid new password !");
        }
      } else {
        $("#danger_signup").html("Please enter the valid old password !");
      }
    })
  </script>

  </html>


<?php  } ?>