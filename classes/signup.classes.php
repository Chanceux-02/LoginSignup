<?php //04

class Signup extends Dbh{ //amuni ang naga run sa sulod sang database kag kelangan makesure naka extend sa databse para magamit ta ang mga properties kag methods sa dbh

    protected function setUser($uid, $pwd, $email){ // protected para magamit sang controler ta a, ang mga parameters halin ni sa controler nga ara sa slod sang set user

        $stmt = $this->connect()->prepare('INSERT INTO users (users_uid, users_pwd, users_email) VALUES (?, ?, ?);'); // gin run ya anay ang connections tapos gin prepare ang sql statement nga mag run sa slod sang database.

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); //muni mag hashed sang password para computer lang maka basa sang pass.

        if(!$stmt->execute(array($uid, $hashedPwd, $email))){ //amuni naga check naman kung may error sa execution which is ang mga parameter sa slod sang array nga naga refer sa values sang sql statement sa babaw. Dire ma assign sang value sa mga question mark sa babaw. Amunni ang naga prevent sa sql injection. Gina prepare anay tapos gin execute.
            $stmt = null; // kung error amuni ang ma delete sang prepared statement
            header("location: ../index.php?error=stmtfailed"); // dire makita ang error
            exit();
        }
        
        $stmt = null;
    }


    protected function checkUser($uid, $email){ // amuni ang method sang naga prepare sang sql statement para i select ang mga user kag email sa rows.

        $stmt = $this->connect()->prepare('SELECT users_uid FROM users WHERE users_uid = ? OR users_email = ?;');

        if(!$stmt->execute(array($uid, $email))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $resultCheck = false; // nag initialize sang variable para sudlan sang result karon
        if($stmt->rowCount() > 0){ // amuni ang naga check sang rows sa database, kag naga pangita kung naga exist ang email kag ang  username sa database. Amuni ang ma pasa sang data to sa controler para sa validation nga method. Dire naman ang condition nga kung ang rowcount is greater than 0 meaning mayara sang naga exist nga email or username sa slod sang database, ma return sya false, pero kung zero naman ma return sya true kay wala sang may naga exist. Tapos i pasa ya sa controler para ma validate(ang sa ari di naga prepare lang sang statement kag naga kwa sang row count kung may naga exist)
            $resultCheck = false;
        }else{
            $resultCheck = true;
        }

        return $resultCheck;
    }

}