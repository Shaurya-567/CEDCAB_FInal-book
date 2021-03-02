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

    <div class="main_card">
      <div class="card text-center card_mar" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Ride Requests</h5>
          <p class="card-text" id="allriderquest"></p>
          <a href="#" class="btn btn-primary btn_color" id="btn_riderequest">Ride Requests</a>
        </div>
      </div>
      <div class="card text-center card_mar" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Compeleted Rides</h5>
          <p class="card-text" id="allcompleteride"></p>
          <a href="#" class="btn btn-primary btn_color" id="btn_ridecompleted">Compeleted Rides</a>
        </div>
      </div>
      <div class="card text-center card_mar" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Canceled Rides</h5>
          <p class="card-text" id="allcancelride"></p>
          <a href="#" class="btn btn-primary btn_color" id="btn_ridecancel">Canceled Rides</a>
        </div>
      </div>
      <div class="card text-center card_mar" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">All Rides</h5>
          <p class="card-text" id="allrides"></p>
          <a href="#" class="btn btn-primary btn_color" id="btn_allrideadmin">All Rides</a>
        </div>
      </div>

    </div>

    <div class="main_card">
      <div class="card text-center card_mar" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">All Users</h5>
          <p class="card-text" id="all_user"></p>
          <a href="#" class="btn btn-primary btn_color" id="btm_allusershow">All Users</a>
        </div>
      </div>
      <div class="card text-center card_mar" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Serviceable Locations</h5>
          <p class="card-text" id="alllocation"></p>
          <a href="./adminloaction.php" class="btn btn-primary btn_color" id="btn_alllocation">Serviceable Locations</a>
        </div>
      </div>
      <div class="card text-center card_mar" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Total Earn</h5>
          <p class="card-text" id="total_earn"></p>
          <a href="#" class="btn btn-primary btn_color" id="total_earnrides">Total Earn Ride</a>
        </div>
      </div>
      <div class="card text-center card_mar" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Manage Distance</h5>
          <p class="card-text" id="total_distance">9940</p>
          <a href="#" class="btn btn-primary btn_color" id="btn_alldistance">Manage Distance</a>
        </div>
      </div>

    </div>

    <div id="tbl_id">
    <div id="allsortdiv">
      <h1 id="table_detail"></h1><div id="btnallascdesc"></div> </div>
      <table id="tbl">
        <thead id="tbl_ridedeatil">
          <td><button type="button" class="btn btn-info btn_thead" id="btn_idtd">ID</button></td>
          <td><button type="button" class="btn btn-info btn_thead" id="btn_from">From</button></td>
          <td><button type="button" class="btn btn-info btn_thead" id="btn_to">To</button></td>
          <td><button type="button" class="btn btn-info btn_thead"  id="btn_cab">Cab_type</button></td>
          <td><button type="button" class="btn btn-info btn_thead" id="btn_luggage">Name</button></td>
          <td><button type="button" class="btn btn-info btn_thead" id="btn_totalfare">Total Fare</button></td>
          <td><button type="button" class="btn btn-info btn_thead" id="btn_status">Status</button></td>
          <td><button type="button" class="btn btn-info btn_thead" id="btn_action">Action</button></td>

        </thead>
        <thead id="tbl_userdeatil">
          <td><button type="button" class="btn btn-info btn_thead" id="btn_idtd">ID</button></td>
          <td><button type="button" class="btn btn-info btn_thead" id="btn_from">Username</button></td>
          <td><button type="button" class="btn btn-info btn_thead" id="btn_to">Email</button></td>
          <td><button type="button" class="btn btn-info btn_thead"  id="btn_cab">Date</button></td>
          <td><button type="button" class="btn btn-info btn_thead" id="btn_luggage">Mobile</button></td>
          <td><button type="button" class="btn btn-info btn_thead" id="btn_totalfare">Admin</button></td>
          <td><button type="button" class="btn btn-info btn_thead" id="btn_status">Status</button></td>
          <td><button type="button" class="btn btn-info btn_thead" id="btn_action">Action</button></td>

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


    <?php include_once '../admin/layout/footer.php'; ?>
  </body>
  <script>
    $(document).ready(function() {
      getcountallpendingrides();
      getcountallcompleteride();
      getcountallcancelride();
      getcountallride();
      getcountalluser();
      getcountlocation();
      gettotalearnadmin();
      gettotaldistance();
      getshowallpendingrideadmin();

    })

    function ascfarecanceladmin(){
      $("#tbl_user").html("");
      $.ajax({
        type:"post",
        url:"../helper.php",
        data:{action:"ascfarecanceladmin"},
        success:function(res){
          let jdata=JSON.parse(res);
       
          j=1;
          $("#table_detail").text("All Ride Detail :--")
          for (let i = 0; i < jdata.length; i++) {

            if (jdata[i].status == 1) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].name + " </td><td> ₹" + jdata[i].total_fare + " "+ " </td><td><span class='badge badge-warning btn_color'>Pending Ride</span></td><td><button class='btn btn-warning btn_color' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (jdata[i].status == 2) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].name + " "+" Kg. </td><td> ₹" + jdata[i].total_fare +" "+ "</td><td><span class='badge badge-success'>Complete Ride</span></td><td><button class='btn btn-success ' id='btn_detail'onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (jdata[i].status == 0) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].name +" "+ " Kg. </td><td> ₹" + jdata[i].total_fare + " "+"</td><td><span class='badge badge-danger'>Cancel Ride</span></td><td><button class='btn btn-danger ' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            }
            ++j;
          }
          
        },error:function(err){
          alert("Something went wrong");
        }
      })
    }
    function descfarecanceladmin(){
      $("#tbl_user").html("");
      $.ajax({
        type:"post",
        url:"../helper.php",
        data:{action:"descfarecanceladmin"},
        success:function(res){
          let jdata=JSON.parse(res);
        
          j=1;
          $("#table_detail").text("All Ride Detail :--")
          for (let i = 0; i < jdata.length; i++) {

            if (jdata[i].status == 1) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].name + " </td><td> ₹" + jdata[i].total_fare + " "+ " </td><td><span class='badge badge-warning btn_color'>Pending Ride</span></td><td><button class='btn btn-warning btn_color' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (jdata[i].status == 2) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].name + " "+" Kg. </td><td> ₹" + jdata[i].total_fare +" "+ "</td><td><span class='badge badge-success'>Complete Ride</span></td><td><button class='btn btn-success ' id='btn_detail'onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (jdata[i].status == 0) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].name +" "+ " Kg. </td><td> ₹" + jdata[i].total_fare + " "+"</td><td><span class='badge badge-danger'>Cancel Ride</span></td><td><button class='btn btn-danger ' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            }
            ++j;
          }
          
        },error:function(err){
          alert("Something went wrong");
        }
      })
    }
    function asccabtypecanceladmin(){
      $("#tbl_user").html("");
      $.ajax({
        type:"post",
        url:"../helper.php",
        data:{action:"asccabtypecanceladmin"},
        success:function(res){
          let jdata=JSON.parse(res);
        
          j=1;
          $("#table_detail").text("All Ride Detail:--")
          for (let i = 0; i < jdata.length; i++) {

            if (jdata[i].status == 1) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].name + " </td><td> ₹" + jdata[i].total_fare + " "+ " </td><td><span class='badge badge-warning btn_color'>Pending Ride</span></td><td><button class='btn btn-warning btn_color' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (jdata[i].status == 2) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].name + " "+" Kg. </td><td> ₹" + jdata[i].total_fare +" "+ "</td><td><span class='badge badge-success'>Complete Ride</span></td><td><button class='btn btn-success ' id='btn_detail'onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (jdata[i].status == 0) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].name +" "+ " Kg. </td><td> ₹" + jdata[i].total_fare + " "+"</td><td><span class='badge badge-danger'>Cancel Ride</span></td><td><button class='btn btn-danger ' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            }
            ++j;
          }
          
        },error:function(err){
          alert("Something went wrong");
        }
      })
    }
    function desccabtypecanceladmin(){
      $("#tbl_user").html("");
      $.ajax({
        type:"post",
        url:"../helper.php",
        data:{action:"desccabtypecanceladmin"},
        success:function(res){
          let jdata=JSON.parse(res);
        
          j=1;
          $("#table_detail").text("All Ride Detail  :--")
          for (let i = 0; i < jdata.length; i++) {

            if (jdata[i].status == 1) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].name + " </td><td> ₹" + jdata[i].total_fare + " "+ " </td><td><span class='badge badge-warning btn_color'>Pending Ride</span></td><td><button class='btn btn-warning btn_color' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (jdata[i].status == 2) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].name + " "+" Kg. </td><td> ₹" + jdata[i].total_fare +" "+ "</td><td><span class='badge badge-success'>Complete Ride</span></td><td><button class='btn btn-success ' id='btn_detail'onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (jdata[i].status == 0) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i].pickup + "</td><td>" + jdata[i].drop + "</td><td>" + jdata[i].cab + "</td>" + "<td>" + jdata[i].name +" "+ " Kg. </td><td> ₹" + jdata[i].total_fare + " "+"</td><td><span class='badge badge-danger'>Cancel Ride</span></td><td><button class='btn btn-danger ' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ") >View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            }
            ++j;
          }
          
        },error:function(err){
          alert("Something went wrong");
        }
      })
    }
 
    $("#btn_riderequest").on("click", function(e) {
      $("#tbl_ridedeatil").show();
      $("#tbl_userdeatil").hide();
      $("#btnallascdesc").html("");
      e.preventDefault();
      $("#tbl_user").html("");
      getshowallpendingrideadmin();
    })

    $("#btn_ridecompleted").on("click", function(e) {
      e.preventDefault();
      $("#tbl_user").html("");
      $("#btnallascdesc").html("");
  
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          action: "showcompletedrideadmin"
        },
        success: function(result) {
          let jdata = JSON.parse(result);
         $("#table_detail").text(" Completed Rides Detail :--");
          let j = 1;
          for (let i = 0; i < jdata.length; i++) {
            let td = "<tr><td>" + j + "</td><td>" + jdata[i]['pickup'] + "</td><td>" + jdata[i]['drop'] + "</td><td>" + jdata[i]['cab'] + "</td><td>" + jdata[i]['name'] + "  " + " </td><td> ₹ " + jdata[i]['total_fare'] + " " + " </td><td><span class='badge badge-success'>Complete Ride</span></td><td><button class='btn btn-success ' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ")>View Detail</button></td></tr>";
            $("#tbl_user").append(td);
            ++j;
          }
        }
      })
    })

    $("#btn_ridecancel").on("click", function(e) {
      e.preventDefault();
      $("#tbl_ridedeatil").show();
      $("#tbl_userdeatil").hide();
      $("#btnallascdesc").html("");
     
      $("#tbl_user").html("");
      $("#table_detail").text(" Cancel Rides Detail :--");
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          action: "showcancelrideadmin"
        },
        success: function(result) {
          let jdata = JSON.parse(result);

          let j = 1;
          for (let i = 0; i < jdata.length; i++) {
            let td = "<tr><td>" + j + "</td><td>" + jdata[i]['pickup'] + "</td><td>" + jdata[i]['drop'] + "</td><td>" + jdata[i]['cab'] + "</td><td>" + jdata[i]['name'] + "  " + " </td><td> ₹ " + jdata[i]['total_fare'] + " " + " </td><td><span class='badge badge-danger'>Cancel Ride</span></td><td><button class='btn btn-danger btn_cancelride ' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ")>View Detail</button></td></tr>";
            $("#tbl_user").append(td);
            ++j;
          }
        }
      })
    })

    $("#btn_allrideadmin").on("click", function(e) {
      e.preventDefault();
      $("#tbl_ridedeatil").show();
      $("#tbl_userdeatil").hide();
      $("#btnallascdesc").html("");
     
      $("#table_detail").text(" All Rides Detail :--");
      $("#tbl_user").html("");
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          action: "showallrideadmintable"
        },
        success: function(result) {
          let jdata = JSON.parse(result);
        
          let btn="<button class='btn btn-info btnclssort' id='btn_soertassendingfare' onclick='ascfarecanceladmin()'>Assending Fare</button><button class='btn btn-info btnclssort' id='btn_sortdessendingfare' onclick='descfarecanceladmin()'>Dessending Fare</button><button class='btn btn-info btnclssort' id='btn_sortassendingdate' onclick='asccabtypecanceladmin()'>Assending Cab Type</button><button class='btn btn-info btnclssort' id='btn_sortdessendingdate' onclick='desccabtypecanceladmin()'>Dessending Cab Type</button>"
          $("#btnallascdesc").append(btn);
          let j = 1;
          for (let i = 0; i < jdata.length; i++) {
            if (jdata[i]['status'] == 0) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i]['pickup'] + "</td><td>" + jdata[i]['drop'] + "</td><td>" + jdata[i]['cab'] + "</td><td>" + jdata[i]['name'] + "  " + " </td><td>₹ " + jdata[i]['total_fare'] + " " + " </td><td><span class='badge badge-danger'>Cancel Ride</span></td><td><button class='btn btn-danger btn_cancelride ' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ")>View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (jdata[i]['status'] == 2) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i]['pickup'] + "</td><td>" + jdata[i]['drop'] + "</td><td>" + jdata[i]['cab'] + "</td><td>" + jdata[i]['name'] + "  " + " </td><td> ₹ " + jdata[i]['total_fare'] + " " + " </td><td><span class='badge badge-success'>Complete Ride</span></td><td><button class='btn btn-success ' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ")>View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            } else if (jdata[i]['status'] == 1) {
              let td = "<tr><td>" + j + "</td><td>" + jdata[i]['pickup'] + "</td><td>" + jdata[i]['drop'] + "</td><td>" + jdata[i]['cab'] + "</td><td>" + jdata[i]['name'] + "  " + " </td><td> ₹ " + jdata[i]['total_fare'] + " " + " </td><td><span class='badge badge-info'>Pending Ride</span></td><td><button class='btn btn-success btn_color' id='btn_detail' onclick=funview(" + jdata[i].ride_id + ")>View Detail</button></td></tr>";
              $("#tbl_user").append(td);
            }
            ++j;
          }

        }
      })
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
            
            $(".modal_fare").html("Ride Id: "+jdata[0].ride_id+"<br> Customr Name: "+ "  "+jdata[0].name+" <br> Ride Status: Pending Ride <br>"+"Pick Up Location: " + jdata[0].pickup + "<br> " + " Drop Location: " + jdata[0].drop + " <br> " + " Cab Type:" + jdata[0].cab + " <br> " + "Book Date: " + jdata[0].ride_date +
              " <br> Your Luggage : " + jdata[0].luggage + " Kg. <br> " + " Total Distance: " + jdata[0].total_distance + " KM.<br> " + " Total Fare: ₹  " +
              jdata[0].total_fare + " ");
            $("#exampleModalCenter").modal('show');
          } else if (jdata[0].status == 2) {
           
            $(".modal_fare").html("Ride Id: "+jdata[0].ride_id+"<br> Customr Name: "+ "  "+jdata[0].name+" <br> Ride Status: Completed Ride <br>"+"Pick Up Location: " + jdata[0].pickup + "<br> " + " Drop Location: " + jdata[0].drop + " <br>" + "Cab Type:" + jdata[0].cab + "<br>" + " Book Date: " + jdata[0].ride_date +
              "<br>Your Luggage : " + jdata[0].luggage + " Kg. <br>" + "Total Distance: " + jdata[0].total_distance + " KM. <br> " + "Total Fare:  ₹ " +
              jdata[0].total_fare + " ");
            $("#exampleModalCenter").modal('show');
          } else if (jdata[0].status == 0) {
            
            $(".modal_fare").html("Ride Id: "+jdata[0].ride_id+"<br> Customr Name: "+ "  "+jdata[0].name+" <br> Ride Status: Canceled Ride <br>"+"Pick Up Location: " + jdata[0].pickup + " <br> " + "Drop Location: " + jdata[0].drop + " <br> " + " Cab Type:" + jdata[0].cab + " <br> " + "Book Date: " + jdata[0].ride_date +
              " <br> Your Luggage : " + jdata[0].luggage + " Kg. <br>" + "Total Distance: " + jdata[0].total_distance + " KM. <br> " + " Total Fare:  ₹ " +
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





$("#btm_allusershow").on("click",function(e){
  e.preventDefault();

  $("#tbl_ridedeatil").hide();
      $("#tbl_userdeatil").show();
      $("#table_detail").text(" All User Detail :--");
      $("#tbl_user").html("");
  $.ajax({
    type:"post",
    url:"../helper.php",
    data:{action:"alluserdetail"},
    success:function(result){
    
      let jdata=JSON.parse(result);
  
      let j = 1;
          for (let i = 0; i < jdata.length; i++) {
            if(jdata[i].status==1){
            let td = "<tr><td>" + j + "</td><td>" + jdata[i]['name'] + "</td><td>" + jdata[i]['email'] + "</td><td>" + jdata[i]['date'] + "</td><td>" + jdata[i]['mobile'] + "  " + "</td><td> No </td><td><span class='badge badge-info'>Active User</span></td><td><button class='btn btn-danger btn_cancelride' onclick='blockactiveuser(" + jdata[i].user_id  +","+ jdata[i].status + ")'>Block</button></td></tr>";
            $("#tbl_user").append(td);
           
          }
        else if(jdata[i].status==0){
          let td = "<tr><td>" + j + "</td><td>" + jdata[i]['name'] + "</td><td>" + jdata[i]['email'] + "</td><td>" + jdata[i]['date'] + "</td><td>" + jdata[i]['mobile'] + "  " + "</td><td>No </td><td><span class='badge badge-danger'>Block User</span></td><td><button class='btn btn-success btn_color' id='btn_detail' onclick=blockactiveuser(" + jdata[i].user_id +","+ jdata[i].status + ")>Active </button></td></tr>";
            $("#tbl_user").append(td);
        }
        ++j;
        }

    },
    error:function(err){
      alert(err);
    }
  })
})

function blockactiveuser(id,status){
 if(status==1){
   if(confirm("Are you sure want to user blocked")){
   
     $.ajax({
       type:"post",
       url:"../helper.php",
       data:{action:"blockactiveuser",id:id,status:status},
       success:function(res){
        alert("You are successfully Blocked user");
         window.location.replace("index.php");
       },
       error:function(err){
         alert("Something went wrong");
       }
     })
   }
 }
 else if(status==0){
  if(confirm("Are you sure want to user Active")){
  
     $.ajax({
       type:"post",
       url:"../helper.php",
       data:{action:"blockactiveuser",id:id,status:status},
       success:function(res){
       if(res==1){
         alert("You are successfully actived user");
         window.location.replace("index.php");
       }
       },
       error:function(err){
        alert("Something went wrong");
       }
     })
   }
 }
}





    function getshowallpendingrideadmin() {
      $("#tbl_ridedeatil").show();
      $("#tbl_userdeatil").hide();
     
      $("#table_detail").text(" Pending Rides Detail :--");
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          action: "showallpendingrideadmin"
        },
        success: function(result) {

          let jdata = JSON.parse(result);
          
          let j = 1;
         
          for (let i = 0; i < jdata.length; i++) {
            let td = "<tr><td>" + j + "</td><td>" + jdata[i]['pickup'] + "</td><td>" + jdata[i]['drop'] + "</td><td>" + jdata[i]['cab'] + "</td><td>" + jdata[i]['name'] + "  " + "</td><td> ₹ " + jdata[i]['total_fare'] + " " + " </td><td><span class='badge badge-info'>Pending Ride</span></td><td><button class='btn btn-danger btn_cancelride' onclick='cancelpending(" + jdata[i].ride_id + ")'>Reject</button><button class='btn btn-success btn_color' id='btn_detail' onclick= 'acceptrideadmin(" + jdata[i].ride_id + ")'>Accept</button></td></tr>";
      
            $("#tbl_user").append(td);
            ++j;
          }

        },
        error: function(err) {
          alert(err);
        }
      })
    }


 function cancelpending(id){
   if(confirm("Are you sure ride has  Cancel?")){
   
   $.ajax({
     type:"post",
     url:"../helper.php",
     data:{action:"cancelpending",ride_id:id},
     success:function(res){
    if(res==1){
      alert("Ride Has Benn Cancel By Admin")
      window.location.replace("index.php");
    }
    else{
      alert("Somthing went wrong!");
    }
     },error:function(err){
       console.log(err);
     }
    
   })
  }

 }

 function acceptrideadmin(id){
  if(confirm("Are you sure ride has Booked?")){
 

   
   $.ajax({
     type:"post",
     url:"../helper.php",
     data:{action:"acceptrideadmin",ride_id:id},
     success:function(res){
     
    if(res==1){
      alert("Ride Has Benn Booked By Admin")
      window.location.replace("index.php");
    }
    else{
      alert("Somthing went wrong!");
    }
     },error:function(err){
       console.log(err);
     }
    
   })
  }

 }







    function getcountallpendingrides() {
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          action: "getcountallpendingrides"
        },
        success: function(result) {
          let jdata = JSON.parse(result);
          $("#allriderquest").text(jdata['count(ride_id)']);
        },
        error: function(error) {
          alert("Something went wrong" + error);
        }
      })

    }

    function getcountallcompleteride() {
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          action: "getcountallcompleteride"
        },
        success: function(result) {
          let jdata = JSON.parse(result);
          $("#allcompleteride").text(jdata['COUNT(ride_id)']);
        },
        error: function(error) {
          alert("Something went wrong" + error);
        }
      })

    }

    function getcountallcancelride() {
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          action: "getcountallcancelride"
        },
        success: function(result) {
          let jdata = JSON.parse(result);
          $("#allcancelride").text(jdata['COUNT(ride_id)']);
        },
        error: function(error) {
          alert("Something went wrong" + error);
        }
      })

    }

    function getcountallride() {
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          action: "getcountallride"
        },
        success: function(result) {
          let jdata = JSON.parse(result);

          $("#allrides").text(jdata['count(ride_id)']);
        },
        error: function(error) {
          alert("Something went wrong" + error);
        }
      })

    }

    function getcountalluser() {
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          action: "getcountalluser"
        },
        success: function(result) {
          let jdata = JSON.parse(result);
          

          $("#all_user").text(jdata['cc']);
        },
        error: function(error) {
          alert("Something went wrong" + error);
        }
      })

    }

    function getcountlocation() {
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          action: "getcountlocation"
        },
        success: function(result) {
          let jdata = JSON.parse(result);
          $("#alllocation").text(jdata['COUNT(name)']);
        },
        error: function(error) {
          alert("Something went wrong" + error);
        }
      })

    }

    function gettotalearnadmin() {
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          action: "gettotalearnadmin"
        },
        success: function(result) {
          let jdata = JSON.parse(result);
          $("#total_earn").text(jdata['sum(total_fare)']+" Rs.");
        },
        error: function(error) {
          alert("Something went wrong" + error);
        }
      })

    }

    function gettotaldistance() {
      $.ajax({
        type: "post",
        url: "../helper.php",
        data: {
          action: "gettotaldistanceadmin"
        },
        success: function(result) {
          let jdata = JSON.parse(result);
          $("#total_distance").text(jdata['sum(distance)']);
        },
        error: function(error) {
          alert("Something went wrong" + error);
        }
      })

    }
  </script>

  </html>

<?php
} ?>