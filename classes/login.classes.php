<?php

class Login extends Dbh{

    protected function getUser($uid, $pwd){  //ari nadi nag sulod ang halin sa controler

        $stmt = $this->connect()->prepare('SELECT users_pwd FROM users WHERE users_uid = ? OR users_email = ?;'); //dire na nag prepare sang statement


        if(!$stmt->execute(array($uid, $pwd))){ // dire na nag decision validation kung ano himuon if nag error to sa piyak, dire gin execute or gin sudlan ang mga values sa sql statement nga gin prepare.
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0){ // dire gin lantaw kung nag exist or wala 
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        
        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC); //gin grab as associative array
        $checkPwd = password_verify($pwd, $pwdHashed[0]["users_pwd"]); //dire gin check kung equal or nd kag gin check sa database kung ara

        if($checkPwd == false){ // the password is not the same
            $stmt = null;
            header("location: ../index.php?error=wrongpassword");
            exit();
        }
        else if($checkPwd == true){ // the password is the same
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_uid = ? OR users_email = ? AND users_pwd = ?;'); // nag prepare liwat kag nag select username or email and password.

            if(!$stmt->execute(array($uid, $uid, $pwd))){ //gin check ang email, uid, kag password (same $uid kay amuna ang variable nga gin construct para mag grab sang data sa form nga naga kwa sang uid).
                $stmt = null;
                header("location: ../index.php?error=stmtfailed");
                exit();
            }
            if($stmt->rowCount() == 0){ // dire nag rowcount kung may user or wala
                $stmt = null;
                header("location: ../index.php?error=stmtfailed");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC); 

            session_start();    // if successfull ma start ang session
            $_SESSION["userid"] = $user[0]["users_id"];         // dire nag assign sang session name kag gin assign sa variable
            $_SESSION["useruid"] = $user[0]["users_uid"];

        }

        $stmt = null;
    }

}