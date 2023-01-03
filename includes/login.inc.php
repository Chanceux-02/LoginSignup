<?php

if(isset($_POST["submit"])){


//Grabbing data

$uid = $_POST["uid"]; //nag grab data sa login form
$pwd = $_POST["pwd"];

//Instantiate SignupCOntr class         nag instantiate
include "../classes/dbh.classes.php";
include "../classes/login.classes.php";
include "../classes/login-contr.classes.php";
$login = new LoginContr($uid, $pwd);

// Running error handlers and user sign up          nag validate sang datas

$login->loginUser(); 

//Going to back to front page kung successful ang log in
header("location: ../loggedin.php?error=none");

}