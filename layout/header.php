<?php


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
  <title>header</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light " id="mincls">
    <a class="navbar-brand nav_a_link" href="index.php"><span id="spanCid">C</span>ed<span id="spanId">C</span>ab</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="maindiv">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active color_a" >
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active color_a">
            <a class="nav-link" href="About.php">About US <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active color_a">
            <a class="nav-link" href="#">Contact US <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active color_a">
            <a class="nav-link" href="signup.php">Sign Up <span class="sr-only">(current)</span></a>
          </li>
          
          <li class="nav-item active color_a">
            <a class="nav-link" href="login.php">Log IN <span class="sr-only">(current)</span></a>
          </li>
          
         
        </ul>
      </div>
    </div>
  </nav>
</body>
</html>
<?php } ?>