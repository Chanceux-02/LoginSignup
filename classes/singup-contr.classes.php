<?php //02

class SignupContr extends Signup{ // amuna ang gin una himo after sang sign up.inc tapos constructor.class tapos sign up.class

    private $uid;
    private $pwd;
    private $pwdrepeat; // panwag sini properties amuni ang permi ko nga nalipatan whooooo!!! grr!
    private $email;

    public function __construct($uid, $pwd, $pwdrepeat, $email){ // naga grab sang data halin sa sign up.inc nga file or input

        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdrepeat = $pwdrepeat; //tapos gin assign sa properties nga parameters nga naga kwa sang input halin sa sign up
        $this->email = $email;

    }

    public function signupUser(){ //amuni na ang ma grab sang mga error methods sa dalom kag ma validate kung false ma send error kag ma balik sa location nga gusto kag i exit na ang tanan nga script.

       if($this->emptyInput() == false){

        //echo "Empty input!";
        header("location: ../index.php?error=emptyinput");
        exit();
       }

       if($this->invalidUid() == false){

        //echo "Empty input!";
        header("location: ../index.php?error=invaliduid");
        exit();
       }

       if($this->invalidEmail() == false){

        //echo "Empty input!";
        header("location: ../index.php?error=invalidemail");
        exit();
       }

       if($this->pwdMatch() == false){

        //echo "Empty input!";
        header("location: ../index.php?error=passworddontmatch");
        exit();
       }

       if($this->uidTakenCheck() == false){

        //echo "Empty input!";
        header("location: ../index.php?error=useroremailtaken");
        exit();
       }

       $this->setUser($this->uid, $this->pwd, $this->email); // amuni ang gin grab sang signup.class para i gamiton mag insert sa database sang datas. Dire ya gin sudlan ang mga variables sang setUser nga method.
    }

    private function emptyInput(){ //error handlers (if not filled out correctly it will return false, otherwise it will return true) gina check ya ni kung empty ang mga data or indi.

        $result = false;
        if(empty( $this->uid) ||  empty($this->pwd) ||  empty($this->pwdrepeat) ||  empty($this->email)){

            $result = false;

        }else{
            $result = true;
        }
        
        return $result;
    }

    private function invalidUid(){ //ari naman naga check sang user id kung valid gamit ang pregmatch kung ara sa username input kung wala ma false like sang mga kama, pintok or special characters.

        $result = false;
        if(!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)){

            $result = false;

        }else{
            $result = true;
        }
        
        return $result;
    }

    private function invalidEmail(){ // ari naman di naga check sang email gamit ang builtin method do gina check ya nga dapat may @

        $result = false;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){

            $result = false;

        }else{
            $result = true;
        }
        
        return $result;
    }

    private function pwdMatch(){ // dire naman amuni ang naga check sang password kung naga match or wala

        $result = false;
        if($this->pwd !== $this->pwdrepeat){

            $result = false;

        }else{
            $result = true;
        }
        
        return $result;
    }

    private function uidTakenCheck(){ // amuni ang naga check sang username kag email kung naga exist na sa database or wala, gin kwa ya ni ang data nga ara sa sign up.classes kay dapat pag tapos sang prepare kag execute kwaon ang data kag i check kung may naga exist or wala.

        $result = false;
        if(!$this->checkUser($this->uid, $this->email)){ // dire ya na i validate kung ang check user is false or not true (sa rowcount kung me ga exist) ma return sya false, else true.

            $result = false;

        }else{
            $result = true;
        }
        
        return $result;
    }



}