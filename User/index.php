<?php
session_start();
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title><?php echo $_SESSION['user']['name'] . "Book _Cab"; ?></title>
  </head>

  <body>
    <?php include_once './layout/header.php' ?>

    <div class="main_card">
      <div class="card text-center card_mar" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Pending Ride</h5>
          <p class="card-text" id="pending"></p>
          <a href="#"> <button class="btn btn-primary btn_color" id="btn_pending">Pending Ride </button> </a>
        </div>
      </div>
      <div class="card text-center card_mar" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Cancel Ride</h5>
          <p class="card-text" id="cancel_ride"></p>
          <a href="#"> <button class="btn btn-primary btn_color" id="btncancel_ride">Cancel Ride </button></a>
        </div>
      </div>
      <div class="card text-center card_mar" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Total Expenses</h5>
          <p class="card-text" id="total_expenses"></p>
          <a href="#"> <button class="btn btn-primary btn_color" id="btn_expense">Total Expenses</button></a>
        </div>
      </div>
      <div class="card text-center card_mar" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">All Rides</h5>
          <p class="card-text" id="all_rides"></p>
          <a href="#"> <button class="btn btn-primary btn_color" id="btn_totalfare">All Rides </button> </a>
        </div>
      </div>

    </div>
    <div id="tbl_id">
    <div id="allsortdiv">
      <h1 id="table_detail"></h1>
      </div>
      <table id="tbl">
        <thead>
          <td><button type="button" class="btn btn-info btn_thead">ID</button></td>
          <td><button type="button" class="btn btn-info btn_thead">From</button></td>
          <td><button type="button" class="btn btn-info btn_thead">To</button></td>
          <td><button type="button" class="btn btn-info btn_thead">Cab_type</button></td>
          <td><button type="button" class="btn btn-info btn_thead">Luggage</button></td>
          <td><button type="button" class="btn btn-info btn_thead">Total Fare</button></td>
          <td><button type="button" class="btn btn-info btn_thead" >Status</button></td>
          <td><button type="button" class="btn btn-info btn_thead" >Action</button></td>

        </thead>
        <tbody id="tbl_user">

        </tbody>


      </table>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header modal_head">
            <h5 class="modal-title modal_h5" id="exampleModalLongTitle">Customer Ride</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modal_btnclosecross">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body modal_fare" id="modalbody">

          </div>
          <div class="modal-footer modal_btnfoot">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="modal_btnclose">Close</button>

          </div>
        </div>
      </div>
    </div>
    <!-- <p id="tbl_user" ></p> -->

    <?php include_once './layout/footer.php';


    ?>
  </body>
  <script>
    $(document).ready(function() {
      
      getpendingridecls();
      getcancelride();
      getpendingride();
      getallrides();
      gettotalexpensive();
    })

    $("#btncancel_ride").on("click", function() {
      // e.preventDefault();
      $("#tbl_user").html("");
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          "action": "cancelride_user"
        },
        success: function(res) {

          let jdata = JSON.parse(res);
         
          let len1 = jdata.array1;
          let len2 = jdata.array2;
          j = 1;
          
          for (let i = 0; i < len1.length; i++) {

            if (len1[i].status == 0) {
              let td = "<tr><td>" + j + "</td><td>" + len1[i].name + "</td><td>" + len2[i].name + "</td><td>" + len1[i].cab_type + "</td>" + "<td>" + len1[i].luggage + " Kg. </td><td> ₹ " + len1[i].total_fare + " </td><td><span class='badge badge-danger'>Cancel Ride</span></td><td><button class='btn btn-success btn_color' id='btn_detail'onclick=funview(" + len1[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else {}
            ++j;
          }

        },
        error: function(error) {
          alert(error)
        }
      })


    })

    function ascfarecancel(id){
      $("#tbl_user").html("");
      $.ajax({
        type:"post",
        url:"../helper.php",
        data:{action:"ascfarecancel",id:id},
        success:function(res){
          let jdata=JSON.parse(res);
          j=1;
          $("#table_detail").text("All Ride Detail :--")
          for (let i = 0; i < jdata.length; i++) {

            if (jdata[i].status == 1) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].luggage + " "+" Kg. </td><td> ₹ "+ jdata[i].total_fare +"</td><td><span class='badge badge-warning btn_color'>Pending Ride</span></td><td><button class='btn btn-warning btn_color' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (jdata[i].status == 2) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].luggage + " "+" Kg. </td><td> ₹ " + jdata[i].total_fare +" "+ "</td><td><span class='badge badge-success'>Complete Ride</span></td><td><button class='btn btn-success ' id='btn_detail'onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (jdata[i].status == 0) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].luggage +" "+ " Kg.</td><td> ₹ "+ jdata[i].total_fare +"</td><td><span class='badge badge-danger'>Cancel Ride</span></td><td><button class='btn btn-danger ' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            }
            ++j;
          }
          
        },error:function(err){
          alert("Something went wrong");
        }
      })
    }


    function descfarecancel(id){
      $("#tbl_user").html("");
      $.ajax({
        type:"post",
        url:"../helper.php",
        data:{action:"descfarecancel",id:id},
        success:function(res){
          let jdata=JSON.parse(res);
          j=1;
          $("#table_detail").text("All Ride Detail :--")
          for (let i = 0; i < jdata.length; i++) {

            if (jdata[i].status == 1) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].luggage + " "+" Kg. </td><td> ₹ " + jdata[i].total_fare + " "+ " </td><td><span class='badge badge-warning btn_color'>Pending Ride</span></td><td><button class='btn btn-warning btn_color' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (jdata[i].status == 2) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].luggage + " "+" Kg. </td><td> ₹ " + jdata[i].total_fare +" "+ " </td><td><span class='badge badge-success'>Complete Ride</span></td><td><button class='btn btn-success ' id='btn_detail'onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (jdata[i].status == 0) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].luggage +" "+ " Kg. </td><td>₹ " + jdata[i].total_fare + " "+" </td><td><span class='badge badge-danger'>Cancel Ride</span></td><td><button class='btn btn-danger ' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            }
            ++j;
          }
          
        },error:function(err){
          alert("Something went wrong");
        }
      })
    }

    function descdatecancel(id){
      $("#tbl_user").html("");
      $.ajax({
        type:"post",
        url:"../helper.php",
        data:{action:"descdatecancel",id:id},
        success:function(res){
          let jdata=JSON.parse(res);
          j=1;
          $("#table_detail").text("All Ride Detail :--")
          for (let i = 0; i < jdata.length; i++) {

            if (jdata[i].status == 1) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].luggage + " "+" Kg. </td><td> ₹ " + jdata[i].total_fare + " "+ " </td><td><span class='badge badge-warning btn_color'>Pending Ride</span></td><td><button class='btn btn-warning btn_color' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (jdata[i].status == 2) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].luggage + " "+" Kg. </td><td> ₹ " + jdata[i].total_fare +" "+ "  </td><td><span class='badge badge-success'>Complete Ride</span></td><td><button class='btn btn-success ' id='btn_detail'onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (jdata[i].status == 0) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].luggage +" "+ " Kg. </td><td> ₹ " + jdata[i].total_fare + " "+" </td><td><span class='badge badge-danger'>Cancel Ride</span></td><td><button class='btn btn-danger ' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            }
            ++j;
          }
          
        },error:function(err){
          alert("Something went wrong");
        }
      })
    }


    function ascdatecancel(id){
      $("#tbl_user").html("");
      $.ajax({
        type:"post",
        url:"../helper.php",
        data:{action:"ascdatecancel",id:id},
        success:function(res){
          let jdata=JSON.parse(res);
          j=1;
          $("#table_detail").text("All Ride Detail :--")
          for (let i = 0; i < jdata.length; i++) {

            if (jdata[i].status == 1) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].luggage + " "+" Kg. </td><td> ₹ " + jdata[i].total_fare + " "+ "  </td><td><span class='badge badge-warning btn_color'>Pending Ride</span></td><td><button class='btn btn-warning btn_color' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (jdata[i].status == 2) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].luggage + " "+" Kg. </td><td> ₹ " + jdata[i].total_fare +" "+ " </td><td><span class='badge badge-success'>Complete Ride</span></td><td><button class='btn btn-success ' id='btn_detail'onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (jdata[i].status == 0) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].luggage +" "+ " Kg. </td><td> ₹ " + jdata[i].total_fare + " "+" </td><td><span class='badge badge-danger'>Cancel Ride</span></td><td><button class='btn btn-danger ' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            }
            ++j;
          }
          
        },error:function(err){
          alert("Something went wrong");
        }
      })
    }

    $("#btn_totalfare").on("click", function(e) {
      e.preventDefault();
      $("#tbl_user").html("");
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          action: "showtable"
        },
        success: function(res) {

          let jdata = JSON.parse(res);
          //  console.log(jdata);
          let len1 = jdata.array1;
          let len2 = jdata.array2;
          j = 1;
          let btn="<button class='btn btn-info btnclssort' id='btn_soertassendingfare' onclick='ascfarecancel("+ len1[0].user_id+")'>Assending Fare</button><button class='btn btn-info btnclssort' id='btn_sortdessendingfare' onclick='descfarecancel("+ len1[0].user_id+")'>Dessending Fare</button><button class='btn btn-info btnclssort' id='btn_sortassendingdate' onclick='ascdatecancel("+ len1[0].user_id+")'>Assending Cab Type</button><button class='btn btn-info btnclssort' id='btn_sortdessendingdate' onclick='descdatecancel("+ len1[0].user_id+")'>Dessending Cab Type</button>"
          $("#allsortdiv").append(btn);
          $("#table_detail").text("All Ride Detail :--")
          for (let i = 0; i < len1.length; i++) {

            if (len1[i].status == 1) {
              let td = "<tr><td>" + j + "</td><td>" + len1[i].name + "</td><td>" + len2[i].name + "</td><td>" + len1[i].cab_type + "</td>" + "<td>" + len1[i].luggage + " "+" Kg. </td><td> ₹ " + len1[i].total_fare + " "+ " </td><td><span class='badge badge-warning btn_color'>Pending Ride</span></td><td><button class='btn btn-warning btn_color' id='btn_detail' onclick=funview(" + len1[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (len1[i].status == 2) {
              let td = "<tr><td>" + j + "</td><td>" + len1[i].name + "</td><td>" + len2[i].name + "</td><td>" + len1[i].cab_type + "</td>" + "<td>" + len1[i].luggage + " "+" Kg. </td><td> ₹ " + len1[i].total_fare +" "+ "  </td><td><span class='badge badge-success'>Complete Ride</span></td><td><button class='btn btn-success ' id='btn_detail'onclick=funview(" + len1[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (len1[i].status == 0) {
              let td = "<tr><td>" + j + "</td><td>" + len1[i].name + "</td><td>" + len2[i].name + "</td><td>" + len1[i].cab_type + "</td>" + "<td>" + len1[i].luggage +" "+ " Kg. </td><td> ₹ " + len1[i].total_fare + " "+" </td><td><span class='badge badge-danger'>Cancel Ride</span></td><td><button class='btn btn-danger ' id='btn_detail' onclick=funview(" + len1[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            }
            ++j;
          }
        },
        error: function(err) {
          console.log(err);


        }
      })

    })

    function getpendingridecls() {
      $("#tbl_user").html("");
      
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          action: "showtable"
        },
        success: function(res) {
          //  console.log(res);
          let jdata = JSON.parse(res);
          //  console.log(jdata);
          let len1 = jdata.array1;
          let len2 = jdata.array2;
          // console.log(len1[0]['name']);
          // console.log(len2);
          j = 1;
          $("#table_detail").text("Pending Ride Detail :--")
          
         
          for (let i = 0; i < len1.length; i++) {

            if (len1[i].status == 1) {
              let td = "<tr><td>" + j + "</td><td>" + len1[i].name + "</td><td>" + len2[i].name + "</td><td>" + len1[i].cab_type + "</td>" + "<td>" + len1[i].luggage +" "+ "Kg. </td><td> ₹ " + len1[i].total_fare +" "+ " </td><td><span class='badge badge-info'>Pending Ride</span></td><td><button class='btn btn-danger btn_cancelride' onclick='deletefun(" + len1[i].ride_id + ")'>Cancel</button><button class='btn btn-success btn_color' id='btn_detail' onclick=funview(" + len1[i].ride_id + ")>View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else {
              continue;
            }
            ++j;
          }
        },
        error: function(err) {
          console.log(err);


        }
      })

    }

    function getcancelride() {
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          "action": "cancelride"
        },
        success: function(res) {
          // console.log(res);
          let jdata = JSON.parse(res);
          // console.log(jdata['count(ride_id)']);
          $("#cancel_ride").text(jdata['count(ride_id)']);
        },
        error: function(error) {
          alert(error)
        }
      })
    }

    function getpendingride() {
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          "action": "pendingride"
        },
        success: function(res) {
          // console.log(res);
          let jdata = JSON.parse(res);
          // console.log(jdata['count(ride_id)']);
          $("#pending").text(jdata['count(ride_id)']);
        },
        error: function(error) {
          alert(error)
        }
      })
    }

    function getallrides() {
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          "action": "allrides"
        },
        success: function(res) {
          // console.log(res);
          let jdata = JSON.parse(res);
          // console.log(jdata['count(ride_id)']);
          $("#all_rides").text(jdata['count(ride_id)']);
        },
        error: function(error) {
          alert(error)
        }
      })

    }

    function gettotalexpensive() {
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          "action": "total_Expenses"
        },
        success: function(res) {
          // console.log(res);
          let jdata = JSON.parse(res);
          if(jdata['SUM(total_fare)']==null){
            $("#total_expenses").text("₹ 0");
          }else{
          $("#total_expenses").text("₹ "+jdata['SUM(total_fare)']);
          }
        },
        error: function(error) {
          alert(error)
        }
      })
    }

    $("#btn_expense").on("click", (e) => {
      $("#tbl_user").html("");
      e.preventDefault();
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          "action": "btn_complete"
        },
        success: function(res) {
          let jdata = JSON.parse(res);
          // console.log(jdata);
          let len1 = jdata.array1;
          let len2 = jdata.array2;
          j = 1;
          $("#table_detail").text("Complete Ride Detail :--")
          for (let i = 0; i < len1.length; i++) {

            if (len1[i].status == 2) {
              let td = "<tr><td>" + j + "</td><td>" + len1[i].name + "</td><td>" + len2[i].name + "</td><td>" + len1[i].cab_type + "</td>" + "<td>" + len1[i].luggage +" "+ " Kg. </td><td> ₹ " + len1[i].total_fare +" "+"</td><td><span class='badge badge-success'>Complete Ride</span></td><td><button class='btn btn-success btn_color' id='btn_detail'onclick=funview(" + len1[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else {}
            ++j;
          }

        },
        error: function(error) {
          alert(error)
        }
      })
    })

    $("#btn_pending").on("click", (e) => {
      e.preventDefault();
      $("#tbl_user").html("");
      getpendingridecls();
    })

    function funview(rideid) {
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          action: "viewdetail",
          rideid: rideid
        },
        success: function(result) {
          let jdata = JSON.parse(result);
      
          if (jdata[0].status == 1) {
            
            $(".modal_fare").html("Ride Id: "+jdata[0].ride_id+" <br> Ride Status: Pending Ride <br>"+"Pick Up Location: " + jdata[0].pickup + "<br> " + " Drop Location: " + jdata[0].drop + " <br> " + " Cab Type:" + jdata[0].cab + " <br> " + "Book Date: " + jdata[0].ride_date +
              " <br> Your Luggage : " + jdata[0].luggage + " Kg. <br> " + " Total Distance: " + jdata[0].total_distance + " KM.<br> " + " Total Fare: ₹ " +
              jdata[0].total_fare + " ");
            $("#exampleModalCenter").modal('show');
          } else if (jdata[0].status == 2) {
           
            $(".modal_fare").html("Ride Id: "+jdata[0].ride_id+" <br> Ride Status: Completed Ride <br>"+"Pick Up Location: " + jdata[0].pickup + "<br> " + " Drop Location: " + jdata[0].drop + " <br>" + "Cab Type:" + jdata[0].cab + "<br>" + " Book Date: " + jdata[0].ride_date +
              "<br>Your Luggage : " + jdata[0].luggage + " Kg. <br>" + "Total Distance: " + jdata[0].total_distance + " KM. <br> " + "Total Fare: ₹ " +
              jdata[0].total_fare + " ");
            $("#exampleModalCenter").modal('show');
          } else if (jdata[0].status == 0) {
            
            $(".modal_fare").html("Ride Id: "+jdata[0].ride_id+" <br> Ride Status: Canceled Ride <br>"+"Pick Up Location: " + jdata[0].pickup + " <br> " + "Drop Location: " + jdata[0].drop + " <br> " + " Cab Type:" + jdata[0].cab + " <br> " + "Book Date: " + jdata[0].ride_date +
              " <br> Your Luggage : " + jdata[0].luggage + " Kg. <br>" + "Total Distance: " + jdata[0].total_distance + " KM. <br> " + " Total Fare: ₹ " +
              jdata[0].total_fare + " ");
            $("#exampleModalCenter").modal('show');
          }
        },
        error: function(err) {
          alert("Somathing went wrong." + err);
        }
      })
    }
    $("#modal_btnclose").on("click", function() {
      $(".modal_fare").html("");
      $("#exampleModalCenter").modal('hide');

    })
    $("#modal_btnclosecross").on("click", function() {
      $(".modal_fare").html("");
      $("#exampleModalCenter").modal('hide');

    })

    function deletefun(rideid) {
      $("#tbl_user").html("");
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          action: "cancelridetbl",
          rideid: rideid
        },
        success: function(result) {
          if(result==1){
            window.location.replace("index.php");
          }
          else{
            console.log("Fail");
          }
        },
        error: function(err) {
          console.log(err);
        }

      })
    }
  </script>

  </html>

<?php  } ?>