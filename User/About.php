<?php 
session_start();

// print_r($_SESSION);
if(!isset($_SESSION['user']) ||  $_SESSION['user']['is_admin']!=0 ){
  die("Direct Access Not allowed");
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
  <title><?php echo $_SESSION['user']['name'] ."Book _Cab";?></title>
</head>
<body>
<?php include_once './layout/header.php'?>

<div id="about_main">
 <div class="abt_head">
   <h1 style="color: rgb(225, 202, 33);">About Us</h1>
   <p>At My Intercity Cab, we always try to make car rental simple and cost-effective.
    We believe service that you receive matters! Thus, we’ll help you find the right car for you at a great price. For us return fare is not fair. So, you only need to pay for one way that you are travelling. We also provide your preferred point pick up and drop off to make your journey hassle free.
  Our real reviews, genuine customer feedback and professional cab drivers experience will guide you to choose the best option for your journey.</p>
  <br>
  <h2 style="color: rgb(225, 202, 33);">Why choose us?</h2>
  <ul>
  <li>On time cab arrival.</li>
  <li>Clean & Well-Maintained Cab.</li>
  <li>Highly experienced, well-behaved & Professional Drivers.</li>
  <li>Transparent fares without any hidden charges.</li>
  <li>Multiple payment option.</li>
  <li>GPS tracking.</li>
  <li>24x7 Support.</li>
  </ul>
 </div>
 <div class="card abt_card" style="width: 18rem;">
  <img class="card-img-top" src="../Image/side1.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title" style="color: rgb(225, 202, 33);">Planing Ride</h5>
    <p class="card-text">Plan your outstation journey anywhere across 7000+ destinations.With choice of cars from economy hatchbacks to sedan, from premium sedans to SUVs and Luxury cars like Mercedes Benz;</p>
    
  </div>
</div>
</div>


<div id="about_main2">
 
 <div class="card abt_card" style="width: 18rem;">
  <img class="card-img-top" src="../Image/slide2.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title" style="color: rgb(225, 202, 33);">Amazing Ride</h5>
    <p class="card-text">MyInterityCab is your perfect travel partner if you need to hire a car. Our cab rental services range from outstation cabs to airport taxis. Call us to avail affordable one way and round trip offers.</p>
    
  </div>
</div>
<div class="abt_head">
   <h1 style="color: rgb(225, 202, 33);">How To Works</h1>
   <p>We got the privileged to serve various clients in Government and Semi-Government Departments of Charbhagh as well as Punjab. We have a huge number of clients dealing in private sector also, who are constantly in contact with us for the entire local as well as national car travels trips. We have been highly apprised by our foreign clients for providing luxurious as well as comfortable car hire service to roam in and around the City Beautiful, Chandigarh.

We are easily accessible to our clients, through call or e-mail; our chauffeur will be at your doorstep within 5 to 15 minutes after the booking. We make our clients to save their precious money and time through online car booking service. Thus, feel the difference being the part of the best car rental service in Gorakhpur.</p>
  <br>
  
 </div>
</div>

<?php include_once './layout/footer.php'?>
  
</body>
</html>
<?php   } ?>