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
        <h1>Show All Location</h1>
      </div>
    </div>
    
    <div id="tbl_id">
      <h1 id="table_detail"></h1>
      <table id="tbl">
        <thead id="tbl_ridedeatil">
          <td><button type="button" class="btn btn-info btn_thead" id="btn_idtd">ID</button></td>
          <td><button type="button" class="btn btn-info btn_thead" id="btn_from">Loaction Name</button></td>
          <td><button type="button" class="btn btn-info btn_thead" id="btn_to">Distance</button></td>
          <td><button type="button" class="btn btn-info btn_thead"  id="btn_cab">Available</button></td>
          <td><button type="button" class="btn btn-info btn_thead" id="btn_status">Status</button></td>
          <td><button type="button" class="btn btn-info btn_thead" id="btn_action">Action</button></td>

        </thead>
       
        <tbody id="tbl_user">

        </tbody>


      </table>
    </div>


    <?php include_once '../admin/layout/footer.php'; ?>
  </body>
   <script>
   $("document").ready(function(){
     getalllocationadmin();
   })

   function getalllocationadmin(){
     $.ajax({
       type:"post",
       url:"../helper.php",
       data:{action:"getalllocationadmindetail"},
       success:function(result){
        //  console.log(result);
         let jdata=JSON.parse(result);
         j=1;
         for(let i=0;i<jdata.length;i++){
           if(jdata[i]['is_available']==1){
          let td="<tr><td>"+j+"</td><td>"+jdata[i]['name']+"</td><td>"+jdata[i]['distance'] +"</td><td>Available</td><td><span class='badge badge-success'>Active </span></td><td><button class='btn btn-danger' id='btn_detail' onclick=blocklocation(" + jdata[i]['id'] +","+jdata[i]['is_available'] + ")>Block Location</button><a href='./Editlocation.php?id="+jdata[i]['id']+"' class='btn btn-info' id='btn_detail' >Edit </a> </td></tr>";
          $("#tbl_user").append(td);
         }
         else if(jdata[i]['is_available']==0){
          let td="<tr><td>"+j+"</td><td>"+jdata[i]['name']+"</td><td>"+jdata[i]['distance'] +"</td><td>Unavailable</td><td><span class='badge badge-danger'>Block </span></td><td><button class='btn btn-success ' id='btn_detail' onclick=blocklocation(" + jdata[i]['id'] +","+jdata[i]['is_available'] + ")>Active Location</button><a href='./Editlocation.php?id="+jdata[i]['id']+"'class='btn btn-info' id='btn_detail'>Edit </a></td></tr>";
          $("#tbl_user").append(td);
         }
         ++j;
        }
       }
     })
   }

   function blocklocation(id,available){
     if(available==1){
     if(confirm("Are you sure Location are blocked ")){
     $.ajax({
       type:"post",
       url:"../helper.php",
       data:{action:"locationblockbyadmin",id:id,available:available},
       success:function(res){
        
         if(res!= 1){
           alert("Somthing wetnt wrong");
         }
         else{
         alert("SuccessFully Block Location");
         location.replace("./adminloaction.php");
         }
       },
       error:function(err){
         alert("Somthing went wrong");
       }
     })
    }
    
  }
    else if(available==0){
      if(confirm("Are you sure Location are Active")){
       $.ajax({
       type:"post",
       url:"../helper.php",
       data:{action:"locationblockbyadmin",id:id,available:available},
       success:function(res){
        
         if(res!= 1){
           alert("Somthing wetnt wrong");
         }
         else{
         alert("SuccessFully Active Location");
         location.replace("./adminloaction.php");
         }
       },
       error:function(err){
         alert("Somthing went wrong");
       }
     })
    }

    }
   }

  </script>

</html>

<?php
} ?>