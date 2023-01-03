<?php

class LoginContr extends Login{ // dire na nag construct sang mga need 

    private $uid;
    private $pwd;


    public function __construct($uid, $pwd){

        $this->uid = $uid;
        $this->pwd = $pwd;


    }

    

    public function loginUser(){

       if($this->emptyInput() == false){ // dire ang decision validations

        //echo "Empty input!";
        header("location: ../index.php?error=emptyinput");
        exit();
       }


    
       $this->getUser($this->uid, $this->pwd); // dire ya na gin sudlan ang mga variable sa getUser nga method nga makita mo sa login.classes.php
    }

    private function emptyInput(){   // dire naman nag himo sang mga validation methods

        $result = false;
        if(empty( $this->uid) ||  empty($this->pwd)){

            $result = false;

        }else{
            $result = true;
        }
        
        return $result;
    }



}