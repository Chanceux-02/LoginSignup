<?php //03

class Dbh{      //amuni ang naga connect sa database (connect langgid ni ang iya nga ubra kag mag check sang error kung naga connect or wala)

    protected function connect(){ // kelangan naka protected para magamit sang iban nga class nga nag extend sa iya

        try{ //i try ya anay i run ang function kung mag run te ok, pero kung indi, i catch ya ang error

            $username = "root";
            $password = "12345"; 
            // $host = "localhost";
            // $dbname = "ooplogin ";
            // $server  = "mysql:host=localhost;dbname=ooplogin";

            $dbh = new PDO('mysql:host=localhost;dbname=ooplogin', $username, $password); //ang mysqli function na sa ya, ari di ya mysql command
            return $dbh;

        }catch(PDOException $e){ //amuni mag catch sang error kung nd mag run ang gin try ya nga codes sa babaw. 
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

    }

}