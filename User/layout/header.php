
<nav class="navbar navbar-expand-lg navbar-light " id="mincls2">
    <a class="navbar-brand nav_a_link" href="index.php"><span id="spanCid">C</span>ed<span id="spanId">C</span>ab</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="maindiv">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto user_margn">
          <li class="nav-item active color_a">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active color_a">
            <a class="nav-link" href="About.php">About US <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active color_a">
            <a class="nav-link" href="booknew_ride.php">New Ride <span class="sr-only">(current)</span></a>
          </li>
  
          <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Hello <span id="span_user">
          <?php $name= $_SESSION['user']['name'];
                                                 $newar=split_name($name);
                                                   echo $newar[0];
            
                                                 function split_name($name) {
                                                  $name = trim($name);
                                                  $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
                                                  $first_name = trim( preg_replace('#'.preg_quote($last_name,'#').'#', '', $name ) );
                                                  return array($first_name, $last_name);
                                              }
            
            
            ?>
          </span></a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink" id="header_ullinks">
            <li><a class="dropdown-item drop_item" href="./changeprofile.php">Edit Profile</a></li>
            <li><a class="dropdown-item drop_item" href="./changepassword.php">Change Password</a></li>
            <li><a class="dropdown-item drop_item" href="../logout.php">Log Out</a></li>
            
          </ul>
        </li>
      </ul>
    </div>
          <div id="user_img">
          <img class="img-fluid" src="../<?php echo $_SESSION['user']['file'];?>">   </div>
        </ul>
      </div>
    </div>
  </nav>
