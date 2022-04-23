<?php
//echo $_POST['menuElement'][0].'<br>'.$_POST['menuElement'][1];

require 'connection.inc.php';

    $sql = 'SELECT pageName FROM menu';
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        
        header("Location: ../?error=sqlerror");
        exit(); 

    } else {

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $i = 1;
        while($row = mysqli_fetch_assoc($result)) {

            $sql = 'UPDATE menu SET menuOrder='.$i.' WHERE pageName="'.$_POST['menuElement'][$i-1].'"';
            
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_execute($stmt);

            $i++;
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ../?page=menu");
        exit();
    }