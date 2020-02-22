<?php
session_start();

if (isset($_SESSION['user'])) {
        $sess = $_SESSION['user'];
        echo "<h2>Welcome</h2> " . $sess;

    } else {
        header("Location: ../index.php?error=login");
        exit();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <link href="../css/style.css" rel="stylesheet">

</head>
<script>
    var session =<?php echo json_encode($sess) ?>
</script>
<body>
<form method="post" action="../controlers/logout.php">
<input type="submit" id="logout" value="Logout">
</form>
<nav>
<div id="messages" ></div>
</nav>
<form id="formm">
    <input type="text" id="message" name="message" autocomplete="off" autofocus placeholder="Type your message...">
    <input type="submit" id="send" name="send" value="Send">

</form>
<script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
<script src="../js/app.js"></script>

</body>
</html>