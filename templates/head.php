<head>
    <?php

        require 'admin/inc/connection.inc.php';
    
        $uri = $_SERVER['REQUEST_URI'];
        $query_uri = substr($uri, 1); 

        $sql = 'SELECT * FROM pages WHERE pageURI=?';
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            
            header("Location: ../?connection=failed");
            exit(); 

          } else {

            mysqli_stmt_bind_param($stmt, "s", $query_uri);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $row = mysqli_fetch_assoc($result);

            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            
          }
        
        if(isset($row['pageURI'])) $valid_uri = '/'.$row['pageURI'];
        else {$valid_uri = '/404.php'; }

        switch($uri) {
            case $valid_uri:
              break;
            default:
                header('HTTP/1.1 404 Not Found');
                include('404.php');
                die();
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['metaTitle'] ?></title>
    <meta name="description" content="<?php echo $row['metaDesc'] ?>">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/favicon.PNG">


</head>