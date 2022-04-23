<?php

if(isset($_POST['login-submit'])) {

    require '../../inc/connection.inc.php';

    $user = $_POST['login'];
    $pwd = $_POST['password'];

    if(empty($user) || empty($pwd)) {

        header("Location: ../?error=emptyfields");
        exit();

    } else {

        $sql = 'SELECT * FROM users WHERE loginUsers=?';
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {

            header("Location: ../?error=sqlerror");
            exit(); 

        } else {

            mysqli_stmt_bind_param($stmt, "s", $user);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if($row = mysqli_fetch_assoc($result)) {

                $pwd_check = password_verify($pwd, $row['pwdUsers']);
                if($pwd_check == false) {

                    header("Location: ../?error=wrongpwd");
                    exit(); 

                } elseif ($pwd_check == true) {
                    
                    session_start();
                    $_SESSION['user_id'] = $row['idUsers'];
                    $_SESSION['username'] = $row['loginUsers'];

                    header("Location: ../../?page=sites");
                    exit(); 

                } else {
                    header("Location: ../?error=wrongpwd");
                    exit(); 
                }

            } else {

                header("Location: ../?error=nouser");
                exit(); 
                
            }

        }
        
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }

} else {
    header("Location: ../");
    exit();
}













//adding a user
/*
        $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO users (loginUsers, pwdUsers) VALUES (?, ?)';
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header('Location: ../?error=sqlerror');
        }
        mysqli_stmt_bind_param($stmt, "ss", $user, $hashed_pwd);
        mysqli_stmt_execute($stmt);
*/