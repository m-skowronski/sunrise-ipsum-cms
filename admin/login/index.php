<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: ../");
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title>Zaloguj się - Sunrise Ipsum</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login-wrap">
        <form action="inc/login.inc.php" method="POST" autocomplete="off">
            
            <?php

                if(isset($_GET['error'])) {
                    $err = $_GET['error'];
                    echo '<p class="error-message"><span class="ex-m">! </span>';
                    if($err == 'emptyfields') {
                        echo 'Proszę uzupełnić wszystkie pola';
                    } elseif($err == 'wrongpwd') {
                        echo 'Błędne hasło';
                    } elseif($err == 'sqlerror') {
                        echo 'Błąd bazy danych';
                    } elseif($err == 'nouser') {
                        echo 'Nie ma takiego użytkownika w bazie';
                    }
                    echo '</p>';
                } elseif(isset($_GET['logout'])) {
                    if($_GET['logout'] == 'successful') {
                        echo '<p class="error-message">Wylogowano pomyślnie. <span class="ex-m">Do zobaczenia!</span></p>';
                    }
                }

            ?>
        
            <div class="user-wrap">
                <input type="text" name="login" required>
                <label for="login" class="label">
                    <span class="label-content">Login</span>
                </label>
            </div>
            <div class="pass-wrap">
                <input type="password" name="password" required>
                <label for="login" class="label">
                    <span class="label-content">Hasło</span>
                </label>
                <input type="submit" value="Zaloguj się" class="log-in" name="login-submit">
            </div>
        </form>


    </div>
    
</body>
</html>