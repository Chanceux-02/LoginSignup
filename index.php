<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OOP Login System with MVC model</title>
</head>
<body>

    <section>
        <h1>Sign Up</h1>
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwdrepeat" placeholder="Repeat password">
            <input type="text" name="email" placeholder="E-mail">
            <br>
            <button type="submit" name="submit">Sign up</button>
        </form>
    </section>
    <section>
        <h1>Log in</h1>
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <br>
            <button type="submit" name="submit">Log in</button>
        </form>
    </section>

</body>
</html>