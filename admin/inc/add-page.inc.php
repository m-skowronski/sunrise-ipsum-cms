<?php

if(isset($_POST['page-submit'])) {

  require 'connection.inc.php';

  $page_name = $_POST['page-name'];
  $uri = $_POST['uri'];
  $title = $_POST['title'];
  $desc = $_POST['meta-desc'];
  $h1 = $_POST['header'];
  $content = $_POST['content'];

  if(empty($page_name)) {

    header("Location: ../?page=new&error=emptyname");
    exit();
  } else {

    if(empty($uri)) {
      $uri = rawurlencode($page_name);
    } else {
      $uri = rawurlencode($uri);
    }

    $sql = 'SELECT * FROM pages WHERE pageName=?';
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            
            header("Location: ../?page=new&error=sqlerror");
            exit(); 

          } else {

            mysqli_stmt_bind_param($stmt, "s", $page_name);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($result)) {
            
              header("Location: ../?page=new&error=nametaken");
              exit(); 
            
            } else { //adding a page
              $sql = 'INSERT INTO pages (pageName, pageURI, metaTitle, metaDesc, pageHeader, pageContent) VALUES (?, ?, ?, ?, ?, ?)';
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header('Location: ../?page=new&error=sqlerror');
                }
                mysqli_stmt_bind_param($stmt, "ssssss", $page_name, $uri, $title, $desc, $h1, $content);
                mysqli_stmt_execute($stmt);

                $sql2 = 'SELECT * FROM menu ORDER BY menuOrder DESC ';
                $stmt2 = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt2, $sql2);
                mysqli_stmt_execute($stmt2);
                $result2 = mysqli_stmt_get_result($stmt2);
                $row2 = mysqli_fetch_assoc($result2);
                $order = $row2['menuOrder']+1;
                

                $sql3 = 'INSERT INTO menu (pageName, menuOrder) VALUES (?, ?)';
                $stmt3 = mysqli_stmt_init($conn);
                if(mysqli_stmt_prepare($stmt3, $sql3)) {
                  mysqli_stmt_bind_param($stmt3, "si", $page_name, $order);
                  mysqli_stmt_execute($stmt3);
                }

            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            
            header("Location: ../?page=new&add=success");
            exit(); 
          }
                 
  }
} else {
  header("Location: ../?page=new");
  exit();
}