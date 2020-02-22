<?php


if (isset($_POST['submit'])) {

        require 'conn.php';

        $name = $_POST['name'];
        $last = $_POST['last'];
        $user = $_POST['user'];
        $password = $_POST['password'];
        $rpPassword = $_POST['cpassword'];

        if (empty($name) || empty($last) || empty($user) || empty($password) || empty($rpPassword)) {
            header("Location: ../templ/signup.php?error=emptyfields&name=\"$name\"&lastname=\"$last\"&user=\"$user");
            exit();

        } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $user)) {
            header("Location: ../templ/signup.php?error=invalidusername&name=\"$name\"&last=\"$last");
            exit();

        } elseif ($password !== $rpPassword) {
            header("Location: .../templ/signup.php?error=passwordcheck&name=\"$name\"&last=\"$last\"&user=\"$user");
            exit();

        } else {
            $sql = "SELECT user FROM users WHERE user=?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../templ/signup.php?");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, 's', $user);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck > 0) {
                    header("Location: ../templ/signup.php?error=usernametaken&name=\"$name\"&last=\"$last");
                    exit();
                } else {
                    $sql = "INSERT INTO users (firsname,lastname,user,password) VALUE (?,?,?,?)";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../templ/signup.php?error=sqlerror");
                        exit();
                    } else {
                        $hpwd = password_hash($password, PASSWORD_DEFAULT);

                        mysqli_stmt_bind_param($stmt, 'ssss', $name, $last, $user, $hpwd);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../index.php?signup=success");
                        exit();
                    }
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

    } else {

        header("Location: ../templ/signup.php");
        exit();
}
