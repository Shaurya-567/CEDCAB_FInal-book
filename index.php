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
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <title>CedCab_check_fare</title>
</head>

<body>
  <?php  include_once './layout/header.php';?>

  <div id="bg_img">
    <h1>Book a City Taxi to your destination in town</h1>
    <p>Choose from a range of categories and prices</p>
    <div id="white_div">
      <button type="button" class="btn btn-warning btn_color">CITY TAXI </button>
      <h3>Your everyday travel partner</h3>
      <h5>AC Cabs for point to point travel</h5>
      <div id="btnpadding">
        <h6 class="danger_msg" id="danger_all"></h6>
        <form id="formId">
          <div class="input-group mb-3">
            <div class="input-group-prepend lbl_cls">
              <label class="input-group-text" for="Pick_UP">Pick UP <span id="starId">*</span></label>

            </div>
            <select class="custom-select slt_cls" id="Pick_UP" name="Pick_UP">
              <option selected value="A">Pick Up Location</option>

            </select>

          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend lbl_cls">
              <label class="input-group-text" for="Drop_loc">Drop<span id="starId">*</span></label>

            </div>
            <select class="custom-select slt_cls" id="Drop_loc" name="Drop_loc">
              <option selected value="A">Drop Location...</option>
             
            </select>

          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend lbl_cls">
              <label class="input-group-text" for="cab_type">Cab Type<span id="starId">*</span></label>
            </div>
            <select class="custom-select slt_cls" id="cab_type" name="cab_type">
              <option selected value="0">Select Cab Type</option>
              <option  value="CedMicro">CedMicro</option>
              <option  value="CedMini">CedMini</option>
              <option  value="CedRoyal">CedRoyal</option>
              <option  value="CedSUV">CedSUV</option>
            </select>

          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend lbl_cls">
              <span class="input-group-text" id="inputGroup-sizing-default">Luggage</span>
            </div>
            <input type="text" name="luggage" id="luggage" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" placeholder="Enter the Luggage in Kg">
          </div>

          <button type="button" id="btnId" class="btn btn-warning btn_color">Calculate Fare</button>
        </form>
        <!-- Button trigger modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header modal_head">
                <h5 class="modal-title modal_h5" id="exampleModalLongTitle">Customer Ride</h5>
                <button type="button" class="close " id="modal_hide" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body modal_fare" id="modal_sess">

              </div>
              <div class="modal-footer modal_btnfoot">
               <button type="button" class="btn btn-secondary" data-dismiss="modal" id="modal_btn">Close</button>
                <button type="button" class="btn btn-primary  btn_color" id="book_ride">BOOK NOW</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php  include_once './layout/footer.php'; ?>
</body>
<script>
  // ********  Pick Up OnChange **********
  $('#Pick_UP').change(function() {
    $("#danger_all").text("");
    $("#Drop_loc option").show();
    $('#Drop_loc option[value=' + $(this).val() + ']').hide();
  });


  // ********  Drop Up OnChange **********
  $('#Drop_loc').change(function() {
    $("#danger_all").text("");
    $("#Pick_UP option").show();
    $('#Pick_UP option[value=' + $(this).val() + ']').hide();
  });
  $('#cab_type').change(function() {
    $("#danger_all").text("");

  });


  // ******** CabType Case CabMicro OnChange **********

  $("#cab_type").on("change", () => {
    let cab = $("#cab_type").val();
    let inp = $("#luggage");
    if (cab == "CedMicro") {
      inp.val("");
      inp.prop('disabled', true);
      inp.attr("placeholder", "Luggage Facility not Available !");
    } else {
      inp.prop('disabled', false);
      inp.attr("placeholder", "Enter the Luggage in Kg!");
    }

  })



  // ********  Calculate Fare with AJax **********
  $("#btnId").on("click", function() {
   let select1 = $('#Pick_UP').val();
  //  let select = $('#Pick_UP option');
  
    let select2 = $('#Drop_loc').val();
    let select3 = $('#cab_type').val();
    let luggage = $("#luggage").val();
    
    if (select1 != "A") {

      if (select2 != "A") {
  
        if (select3 != 0) {
          $("#danger_all").text("");
          let input = {
            select1: select1,
            select2: select2,
            select3: select3,
            luggage: luggage,
            action: "checkfare"
          }
          $.ajax({
            type: "post",
            url: "helper.php",
            data: input,
            success: function(result) {
              
              let res = JSON.parse(result);
              // console.log(res);
            
           
              $(".modal_fare").html("Pick Up Location: " + res.Pick_location+ "<br> " + "Drop Location: " + res.Drop_location+ "<br>" + "Cab Type: " + select3 + "<br>" +
                "Your Luggage: " + res.luggage + " Kg. <br>" + "Total Distance: " + res.total_distance + " KM.<br> " + "Total Fare: " +
                res.total_fare + " Rs.");
              $("#exampleModalCenter").modal('show');
            },
            error: function(data_err) {
              $("#danger_all").html(data_err);

            }

          })

        } else {

          console.log("Please select your Cab Type");
          $("#danger_all").text("Please select your Cab Type");

        }
      } else {

        console.log("Please select your Drop Location");
        $("#danger_all").text("Please select your Drop Location");
      }
    } else {

      console.log("Please select your Pick Location");
      $("#danger_all").text("Please select your Pick Location");
    }


  })
  // ********  Modal button click  **********
  $("#exampleModalCenter").on("click", function() {
      $(".modal_fare").html("");
      $("#exampleModalCenter").modal('hide');

    })
    $("#modal_btn").on("click", function() {
      $(".modal_fare").html("");
      $("#exampleModalCenter").modal('hide');

    })



  $(document).ready(function(){

    getoption();
  })
  function getoption(){
    let select1=$('#Pick_UP');
    let select2=$('#Drop_loc');
    $.ajax({
      type:"post",
      url:"helper.php",
      data:{action:"checkoption"},
      success:function(res){
        // console.log(res);
        let data=JSON.parse(res);
        // console.log(data);
        for(let i=0;i<data.length;i++){
          let option='<option value="'+data[i].id+'">'+data[i].name+'</option>';
         
          select1.append(option);
          select2.append(option);
        }
  

      }
    })

  }
  $("#book_ride").on("click",function(){
// let div=$("#modal_sess").text().trim();
// let arr=div.split(":");


// console.log(arr);
// // console.log(div);
       $.ajax({
         type:'post',
         url:'helper.php',
         data:{action:"checkbookride" ,book:"cabsession"},
         success:function(res){
           console.log(res);
           if(res== 1){
             alert("Cab Booked");
             
           }
           else 
           {
             alert("Please Log In");
            location.replace("login.php") ;
           }
         
         },
         error:function(err){
           die("Error: "+err)
         }
       })
  })
</script>

</html>
<?php } 


?>