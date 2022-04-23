<nav class="menu">
    <a href="/" class="small-logo"><span>S</span><span>I</span></a>
    <div id="hamburger" onclick="showMenu()" class="hamburger-normal">
        <i></i>
        <i></i>
        <i></i>
    </div>
    <ul id="menu-elements" class="hide-menu none-ul">

    <?php

    require 'admin/inc/connection.inc.php';

    $menu_sql = 'SELECT pageName FROM menu ORDER BY menuOrder ASC';
    $menu_stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($menu_stmt, $menu_sql)) {
        
        header("Location: ?connection=failed");
        exit(); 

    } else {

        mysqli_stmt_execute($menu_stmt);
        $menu_result = mysqli_stmt_get_result($menu_stmt);

        while($menu_row = mysqli_fetch_assoc($menu_result)) {

            $menu_sql2 = 'SELECT pageURI FROM pages WHERE pageName="'.$menu_row['pageName'].'"';
            $menu_stmt2 = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($menu_stmt2, $menu_sql2)) {
                
                header("Location: ?connection=failed");
                exit(); 

            } else {


                mysqli_stmt_execute($menu_stmt2);
                $menu_result2 = mysqli_stmt_get_result($menu_stmt2);


                $menu_row2 = mysqli_fetch_assoc($menu_result2);
                echo '<li><a href="/'.$menu_row2['pageURI'].'">'.$menu_row['pageName'].'</a></li>';

        }
        
        
    }

}

    ?>

    </ul>
</nav>