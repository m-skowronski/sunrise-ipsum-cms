<?php

if(isset($_POST['page-submit'])) {

  require 'connection.inc.php';

  $page_name = $_POST['page-name'];
  if(isset($_POST['uri']))
    $uri = $_POST['uri'];
  else
    $uri = "";
  $title = $_POST['title'];
  $desc = $_POST['meta-desc'];
  $h1 = $_POST['header'];
  $content = $_POST['content'];
  echo $content;
  
  if(empty($page_name)) {

    header("Location: ../?page=new&error=emptyname");
    exit();
  } else {

    if(empty($uri) && $_POST['id'] != 1) {
      $uri = rawurlencode($page_name);
    } else {
      $uri = rawurlencode($uri);
    }

    $sql = 'SELECT * FROM pages WHERE idPages=?';
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            
            header("Location: ../?edit=".$_POST['id']."&error=sqlerror");
            exit(); 

          } else {

            mysqli_stmt_bind_param($stmt, "s", $_POST['id']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $row = mysqli_fetch_assoc($result); 
             
            //updating menu
            $sql = 'UPDATE menu SET pageName="'.$page_name.'" WHERE pageName="'.$row["pageName"].'"';
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header('Location: ../?page=new&error=sqlerror');
            }
            mysqli_stmt_execute($stmt);

            //editing page
            $sql = "UPDATE pages SET pageName='".$page_name."', pageURI='".$uri."', metaTitle='".$title."', metaDesc='".$desc."', pageHeader='".$h1."', pageContent='".$content."' WHERE idPages = ".$_POST['id'];
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header('Location: ../?page=new&error=sqlerror');
            }
            mysqli_stmt_execute($stmt);
            
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            
            header("Location: ../?edit=".$_POST['id']."&edited=true");
            exit(); 
          }
                 
  }
} else {
  header("Location: ../?page=sites");
  exit();
}
