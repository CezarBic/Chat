<?php

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

<div id="container" class="container">
    <h2>Sign Up</h2>
    <div id="signup-container">
        <form action="../controlers/signup_cont.php" method="post">
            <input type="text" id="name" name="name" placeholder="First Name">
            <input type="text" id="last" name="last" placeholder="Last Name">
            <input type="text" id="user" name="user" placeholder="Username">
            <input type="password" id="password" name="password" placeholder="Password">
            <input type="password" id="cpassword" name="cpassword" placeholder="Verify password">
            <input type="submit" id="submit" name="submit" value="Submit">
        </form>
    </div>
</div>
</body>

</html>
