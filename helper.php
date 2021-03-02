<?Php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
use PHPMailer\PHPMailer\PHPMailer;



if (isset($_POST['action'])) {
 
  include_once './Class/User.php';
  include_once './Class/Ride_cls.php';
  include_once './Class/Location.php';
  $cls = new User();
  $loc=new Location();
  $ride = new Ride();
  

  switch ($_POST['action']) {

case "verifyemail":
                       $email = $_POST['email'];
                       $checkcls = $cls->checkmail($email);
                       if ($checkcls == 1) {
                           echo 1;
                       } else {
                       $otp = rand(100000, 999999);
                       $_SESSION['session_otp']=$otp;
                       require_once "PHPMailer/PHPMailer.php";
                        require_once "PHPMailer/SMTP.php";
                        require_once "PHPMailer/Exception.php";

                        $mail = new PHPMailer();
                        $mail->isSMTP();
                        $mail->Host = "smtp.gmail.com";
                        $mail->SMTPAuth = true;
                        $mail->Username = "chauhansp07@gmail.com";
                        $mail->Password = "J1o2n3@u4";
                        $mail->Port = 465;
                         $mail->SMTPSecure = "ssl";

                        $mail->isHTML(true);
                        $mail->setFrom($email, $name);
                        $mail->addAddress("$email");
                        $mail->Subject = ("Get Ready to Registration on CedCab to verify OTP");
                         $mail->Body = ("$addres" . " It is a CedCab Registration Form <br> PLease enter the OTP to verify the email ID. Your OTP is " . $otp);

                        if ($mail->send()) {
                         $status = "sucsess";
                        $response = "Email is sent";
                       } else {
                        $status = "failed";
                         $response = "Something went Wrong :<br>" . $mail->ErrorInfo;
                        }
                        try {

                         echo json_encode(array("status"=>$status,"response"=>$response));
                         exit();
                       } catch (Exception $e) {
                        die('Error: ' . $e->getMessage());
                       }
                          }
                          break;

case "signup":          $name = $_POST['name'];
                        $email = $_POST['email'];
                        $mobile = $_POST['mobile']; 
                        $password = $_POST['password'];
                        $filename=$_FILES['file']['name'];
                        $filetype=$_FILES['file']['type'];
                        $filetmp_name=$_FILES['file']['tmp_name'];
                        $fileerror=$_FILES['file']['error'];
                        $filesize=$_FILES['file']['size'];

                        $ext = pathinfo($filename);
                        $valid_ext = array('jpg','jpeg','png');
	                      if (in_array($ext['extension'], $valid_ext)) {
		                   $new_file_name = rand().".".$ext['extension'];
	                   	$path = "upload/".$new_file_name;
	                    	if (move_uploaded_file($filetmp_name, $path)) {
                          $status= $cls->Signup_user($name,$email,$mobile,$password,$path);
                          echo json_encode(array("status"=>$status));
	                    	}
	                    	else{
		                   	
                       echo 0;
		                    }
	}
                       
                      

                         
                         break;
case "loginverify":
                       $password = $_POST['password'];
                        $email = $_POST['email'];
                        $checklogin = $cls->logIncheck($email, $password);
                        if ($checklogin == 1) {
                              echo json_encode(array("status"=>$checklogin,"message"=>"Admin login"));
                         } else if($checklogin == 0){
                           echo json_encode(array("status"=>$checklogin,"message"=>"Userlogin"));
                         }
                         else{
                         echo json_encode(array("status"=>$checklogin,"message"=>"User Blocked By User"));
                         }
                         break;
case "otpverigfyinp": $otp = $_POST['otp'];
                      $otp2=$_SESSION['session_otp'];
                      if($otp == $otp2) 
                       {
                         echo json_encode(array("type"=>"success","message"=>"Email verfication Successfully","status"=>1));
                        }
                       else {
                          echo json_encode(array("type" => "error", "message" => "Email verification failed","status"=>0));
                         }
                        unset($_SESSION['session_otp']);
                          break;
  case "checkoption": $locname=$loc->all_location();
                       echo json_encode($locname);
                       break;
  case "checkfare":  $pick = $_POST['select1'];
                     $drop = $_POST['select2'];
                     $cabtype = $_POST['select3'];
                     $luggage = $_POST['luggage'];
                     $locname=$loc->all_location();
                    //  $total_dis = abs($pick - $drop);
                    for($i=0;$i<count($locname);$i++){
                      if($locname[$i]['id']==$pick){
                        $dist1=$locname[$i]['distance'];
                        $pickname=$locname[$i]['name'];
                      }
                    }
                
                    for($i=0;$i<count($locname);$i++){
                      if($locname[$i]['id']==$drop){
                        $dist2=$locname[$i]['distance'];
                        $dropname=$locname[$i]['name'];
                      }
                    }
                    $total_dis = abs($dist1 - $dist2);
                     $tot_fare=$ride->cal_fare_cab($total_dis,$cabtype,$luggage,$pick,$drop,$pickname,$dropname);
                     $data = array('total_distance'=> $total_dis, 'total_fare' => $tot_fare,'luggage'=>$luggage,"Pick_location"=>$pickname,"Drop_location"=>$dropname);
                     
                     echo json_encode($data);    
                     break;
case "checkbookride" :if(isset($_POST['book'])){
                      if(isset($_SESSION['user'])){
                        $insertdata=$ride->insertnewride();
                        if($insertdata == 1){
                          unset($_SESSION['ride']);
                          echo 1;
                        }
                        else{
                          die("Something went wrong");
                        }
                        
                      }
                      else{
                        echo 0;
                      }
                     }                
                     break;
case "showtable":  $show=$ride->showridedetail();
                    print_r($show);
                    break;
case "modal_check":    $pick=$_SESSION['ride']['pickup_name'];;
                       $drop=$_SESSION['ride']['drop_name'];
                       $cab_type= $_SESSION['ride']['cab_name'];
                       $distance= $_SESSION['ride']['distance'];
                       $luggage= $_SESSION['ride']['luggage'];
                      $total_fare=$_SESSION['ride']['total_fare'];
                     echo json_encode(array("Pick_Up"=>$pick,"Drop"=>$drop,"Cab"=>$cab_type,"Distance"=>$distance,"Luggage"=>$luggage,"Total_fare"=>$total_fare));
                    break;
case "cancelride": $completd=$ride->cancelride();
                      print_r($completd);
                      break;
case "pendingride":  $pending=$ride->pendingride();
                      print_r($pending);
                      break;

 case "allrides"  :   $allride=$ride->allrides();
                      print_r($allride);
                      break; 
                      
 case "total_Expenses":   $totalfare=$ride->totalfare();  
                          print_r($totalfare);
                          break;  
                          
                          
case "btn_complete":      $ridecomplate=$ride->allcompleteride();
                           echo $ridecomplate;
                           break;
case "cancelride_user":     $cancelride=$ride->allcancelride();
                             echo $cancelride;
                            break;
case "viewdetail"  :       $ride_id=$_POST['rideid'];
                          $show=$ride->viewdetail($ride_id);
                           print_r($show);
                           break;
  case "cancelridetbl":    $ride_id=$_POST['rideid'];
                            $cancelridestatus=$ride->ridecancel($ride_id) ;
                            echo $cancelridestatus;
                            break;    
case "updateprofilechange":   $name=$_POST['name']; 
                               $email = $_POST['email'];
                               $mobile = $_POST['mobile'];

                               if(isset($_SESSION['admin'])){
                                $adminid=$_SESSION['admin']['user_id'];
                               $checkprofile=$cls->updateprofile($name,$email,$mobile,$adminid);
                               if($checkprofile ==1){
                                $_SESSION['admin']['email']=$email;
                                $_SESSION['admin']['name']=$name;
                                $_SESSION['admin']['mobile']=$mobile;
                                 echo $checkprofile;
                               }
                              
                              }
                              else if(isset($_SESSION['user']))
                              {
                               $userid=$_SESSION['user']['user_id'];
                               $checkprofile=$cls->updateprofile($name,$email,$mobile,$adminid);
                               if($checkprofile ==1){
                                $_SESSION['user']['email']=$email;
                             $_SESSION['user']['name']=$name;
                              $_SESSION['user']['mobile']=$mobile;
                                 echo $checkprofile;
                               }
                              }
                        
                        break;
 case "changepassword": $oldpassword=$_POST['oldpassword'];
                         $newpassword=$_POST['newpassword'];
                         if(isset($_SESSION['admin'])){
                           $adminid=$_SESSION['admin']['user_id'];
                          $checkpassword=$cls->checkpassword($oldpassword,$newpassword,$adminid);
                          if($checkpassword ==1){
                            $_SESSION['admin']['password']=$newpassword;
                            echo $checkpassword;
                          }
                         
                         }
                         else if(isset($_SESSION['user'])){
                          $userid=$_SESSION['user']['user_id'];
                          $checkpassword=$cls->checkpassword($oldpassword,$newpassword,$userid);
                          if($checkpassword ==1){
                            $_SESSION['user']['password']=$newpassword;
                            echo $checkpassword;
                          }
                         }
                          
                         
                          break;

case "getcountallpendingrides":  $allrideadmin=$ride->countallpendingrideadmin();
                                   echo $allrideadmin;
                                   break;

case "getcountallcompleteride":   $allcompletrideadmin=$ride->getcountallcompleteride();
                                  echo $allcompletrideadmin;
                                  break;

case "getcountallcancelride":  $allcancelrideadmin=$ride->getcountallcancelride();
                                echo $allcancelrideadmin;
                                 break;

case "getcountallride":             $allrideadmin=$ride->countallrideadmin();
                                   echo $allrideadmin;
                                    break;

case "getcountalluser":          $countalluseradmin=$cls->getalluseradmin();
                                 echo $countalluseradmin;
                                 break;

case "getcountlocation":         $adminalllocation=$loc->countalllocation();
                                 echo $adminalllocation;
                                 break;



case "gettotalearnadmin":      $totalearnadmin=$ride->getallearnadmin();
                               echo $totalearnadmin;
                               break;

case "gettotaldistanceadmin":   $totaldistanceadmin=$loc->gettotaldistanceadmin();
                                 echo $totaldistanceadmin;
                                 break;
case "showallpendingrideadmin":   $showpendingride=$ride->showpendingrideadmin();
                                  echo $showpendingride;
                                  break;

case "showcompletedrideadmin":   $showcompletdride=$ride->showcompletdrideadmin();
                                  echo $showcompletdride;
                                  break;

case "showcancelrideadmin" :    $showcancelride=$ride->showcancelrideadmin();
                                  echo $showcancelride;
                                  break;

case "showallrideadmintable" : $showallride=$ride->showallrideadmintable();
                                echo $showallride;
                                break;

case "alluserdetail":   $showalluseradmin=$cls->showalluseradmintable();
                        print_r($showalluseradmin);
                        break;

case "addnewlocationadmin":   $newlocation=$_POST['loc'];
                               $dis=$_POST['dis'];
                             
                      
                            $addnewlocation=$loc->newloactionaddadmin($newlocation,$dis);
                               echo  $addnewlocation;
                               break;

case "getalllocationadmindetail": $alllocation=$loc->getalllocationdeatail();
                                   echo $alllocation;
                                   break;
                                   
case "cancelpending":    $ride_id=$_POST['ride_id'];
                         $cancelpending=$ride->ridecancel($ride_id);
                         echo $cancelpending;
                         break;

case "acceptrideadmin":       $ride_id=$_POST['ride_id'];
                             $acceptrideadmin=$ride->ridebookadmin($ride_id);
                             echo $acceptrideadmin;
                             break;

case "locationblockbyadmin": $id=$_POST['id'];
                             $available=$_POST['available'];
                             $editlocation=$loc->activeblocklocation($id,$available);
                             echo $editlocation;
                             break;


case "updatelocationadmin": $locname=$_POST['loc'];
                             $distance=$_POST['dis'];
                             $is_available=$_POST['radio'];
                              $id=$_POST['id'];
                            
                             $updatelocation=$loc->updatelocationadmin($locname,$distance,$is_available,$id);
                            echo $updatelocation;
                            break;

case "getalldataforedit":   $id=$_POST['id'];
                            $alldetaillocation=$loc->alllocationforedit($id);
                            echo $alldetaillocation;
                            break;


case "blockactiveuser":    $id=$_POST['id'];
                            $status=$_POST['status'];
                            $blockactiveuser=$cls->blockactiveuser($id,$status);
                           echo  $blockactiveuser;
                           break;

case "ascfarecancel":  $id=$_POST['id'];
                      
                        $ascfarecancel=$ride->ascfarecancel($id);
                        echo $ascfarecancel;
                        break;

 case "descfarecancel":  $id=$_POST['id'];
                        $ascfarecancel=$ride->descfarecancel($id);
                        echo $ascfarecancel;
                        break;
 case "ascdatecancel":  $id=$_POST['id'];
                        $ascfarecancel=$ride->ascdatecancel($id);
                        echo $ascfarecancel;
                        break;
 case "descdatecancel":  $id=$_POST['id'];
                        $ascfarecancel=$ride->descdatecancel($id);
                        echo $ascfarecancel;
                        break;
case "ascfarecanceladmin":  $ascfarecanceladmin=$ride->ascfarecanceladmin();
                            echo $ascfarecanceladmin;
                            break;

case "descfarecanceladmin": $descfarecanceladmin=$ride->descfarecanceladmin();
                             echo $descfarecanceladmin;
                             break;
case "asccabtypecanceladmin": $asccabtypecanceladmin=$ride->asccabtypecanceladmin();
                             echo $asccabtypecanceladmin;
                             break;

case "desccabtypecanceladmin":  $desccabtypecanceladmin=$ride->desccabtypecanceladmin();
                              echo $desccabtypecanceladmin;
                              break;






   }
}

else
 {
  echo "Heyyyyy,You cann't directly access!! Back to home page";
}
