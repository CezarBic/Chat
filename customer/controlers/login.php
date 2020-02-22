<?php

if(isset($_POST['login'])){

    require 'conn.php';

    $username = $_POST['luser'];
    $password = $_POST['lpassword'];

    if(empty($username) || empty($password)){
        header("Location: ../index.php?error=empltyfields");
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE user=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pasCheck = password_verify($password, $row['password']);
                if($pasCheck == false){
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }elseif ($pasCheck == true){
                    session_start();
                    $_SESSION['user'] = $row['user'];
                    header("Location: ../templ/chat.php?login=success");
                    echo $row['user'];
                    exit();
                    
                }
                else{
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }
            }else{
                header("Location: ../index.php?error=nouser");
                exit();
            }

        }
    }

}
else{
    header("Location: ../index.php");
    exit();
}