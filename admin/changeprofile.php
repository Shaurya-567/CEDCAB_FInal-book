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
        <h1>UPADTE DETAIL</h1>
      </div>
      <h6 id="danger_signup"></h6>
      <hr>
      <form id="form_signup" enctype="multipart/form-data">
        <div class="form-group">
          <label for="name">NAME</label>
          <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter your new name" name="name" autocomplete="off">

        </div>
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your new email" name="email" autocomplete="off">

        </div>
        <div class="form-group">
          <input type="text" class="form-control" id="otp" aria-describedby="emailHelp" placeholder="Enter your otp" name="otp" autocomplete="off">

        </div>
        <button type="button" class="btn btn-primary" id="btn_otp">Verify OTP</button>
        <div class="form-group">
          <label for="mobile">Mobile</label>
          <input type="text" class="form-control" id="mobile" aria-describedby="emailHelp" placeholder="Enter your new mobile number" name="mobile">
        </div>


        <button type="button" class="btn btn-primary" id="btn_update">Update Profile</button>

      </form>
    </div>
    </div>


    <?php include_once './layout/footer.php' ?>

  </body>
  <script>
    $("#btn_update").on("click", function() {
      let name = $("#name").val();
      let mobile = $("#mobile").val();
      let email = $("#email").val();
      if (name != "" && name.trim() != " ") {
        if (mobile != "" && mobile.trim() != " ") {

          let input = {
            name: name,
            email: email,
            mobile: mobile,
            "action": "updateprofilechange"
          }
          $.ajax({
            type: "post",
            url: "../helper.php",
            data: input,
            success: function(result) {
              // console.log(result);
              if (result == 1) {
                $("#danger_signup").html("Congratulation ! You have Successfully create Account");
                alert("Congratulation ! You have Successfully create Account");
                window.location.replace("index.php");
              } else {
                alert("Somthing Went Wrong!");
                $("#danger_signup").html("Somthing Went Wrong!");
              }

            },
            error: function(err) {
              console.log(err);
            }
          })
        } else {
          $("#danger_signup").html("Please enter the valid mobile.");
        }
      } else {
        $("#danger_signup").html("Please enter the proper name.");
      }
    })

    $("#email").on("change", function() {

      let email = $("#email").val();


      if (email != "" && email.trim() != " ") {
        $("#mobile").prop('disabled', true);
        $("#btn_update").prop('disabled', true);
        $("#file").prop('disabled', true);
        $.ajax({
          type: "post",
          url: "../helper.php",
          data: {
            email: email,
            action: "verifyemail"
          },
          success: function(res) {
            if (res == 1) {
              $("#name").prop('disabled', true);
              $("#mobile").prop('disabled', true);
              $("#btn_update").prop('disabled', true);


              $("#danger_signup").html("Email already exist!");
            } else {
              $("#danger_signup").html("Otp Send Successfully");
              $("#otp").show();
              $("#btn_otp").css("display", "block");

            }

          }

        })
      } else {
        $("#danger_signup").html("Please enter your email");
      }
    })

    $("#btn_otp").on("click", function() {

      let otp = $("#otp").val();
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          otp: otp,
          action: "otpverigfyinp"
        },
        success: function(res) {

          let jdata = JSON.parse(res);

          let status = jdata.status;
          if (status == 1) {
            $("#otp").hide();
            $("#btn_otp").css("display", "none");
            $("#mobile").prop('disabled', false);
            $("#btn_update").prop('disabled', false);
            $("#danger_signup").html("Otp Verify Successfully");

          } else {
            $("#otp").hide();
            $("#btn_otp").css("display", "none");
            $("#danger_signup").html("Otp Verify Failed");
          }
        }
      })

    })
  </script>

  </html>










<?php } ?>