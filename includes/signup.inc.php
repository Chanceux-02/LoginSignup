<?php //01

if(isset($_POST["submit"])){


//Grabbing data

$uid = $_POST["uid"];
$pwd = $_POST["pwd"];
$pwdrepeat = $_POST["pwdrepeat"];
$email = $_POST["email"];

//Instantiate SignupCOntr class                 //gin include para ma locate kung gamiton na ang file
include "../classes/dbh.classes.php";           //connect sa database      
include "../classes/signup.classes.php";        //communicate kag ma prepare sang mga sql statements
include "../classes/singup-contr.classes.php";  // validations kag ma construct sang gamiton nga mga properties
$signup = new SignupContr($uid, $pwd, $pwdrepeat, $email); //amuni ang mag instantiate sang class meaning naga pasa sang data halin sa  file nga ni pakadto sa piyak nga file which is sa constructor nga method kag class. Kelangan isulod ang variable nga naga kwa sang data sa form.

// Running error handlers and user sign up

$signup->signupUser(); //dire i check kung may sala 

//Going to back to front page
header("location: ../index.php?error=none"); // dire ma kadto kung successful lang sign up kag ang flow sa babaw


}