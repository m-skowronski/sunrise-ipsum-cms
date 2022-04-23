<?php

session_start();

if (isset($_SESSION['user_id'])): 
    require 'templates/head.php';

    if(!isset($_GET['page']) && !isset($_GET['edit']) && !isset($_GET['delete'])) header("Location: ?page=sites");
?>


<body>
<div class="all-wrap">

    <header class="user-bar">

        <div class="logo">
            <span class="small-logo"><span>S</span><span>I</span></span>
            <p><span class="accent">Sunrise</span> Ipsum 1.0</p>
        </div>

            <p class="hello">Witaj <span class="accent"><?php echo $_SESSION['username'] ?></span>, jak się masz?</p>

            <form action="login/inc/logout.inc.php" method="post" class="logout-button">
                <input type="submit" name="logout-submit" value="wyloguj się">
            </form>

    </header>

    <div class="page-wrap">

        <nav class="side-menu">
            <ul>
                <li class="main-cat <?php if(isset($_GET['edit']) || isset($_GET['delete']) || $_GET['page'] == 'sites' || $_GET['page'] == 'new') echo 'active'; ?>">
                    <i></i>
                    <span class="clickable <?php if(isset($_GET['edit']) || isset($_GET['delete']) || $_GET['page'] == 'sites') echo 'link-active'; ?>">Strony</span>
                    <ul class="submenu" class="main-cat"> 
                        <li><a href="?page=sites" class="<?php if(isset($_GET['edit']) || isset($_GET['delete']) || $_GET['page'] == 'sites') echo 'link-active'; ?>">Wszystkie</a></li>
                        <li><a href="?page=new" class="<?php if(!isset($_GET['edit']) && !isset($_GET['delete']) && $_GET['page'] == 'new') echo 'link-active'; ?>">Dodaj nową</a></li>
                    </ul>
                </li>
                
                <li class="main-cat <?php if(!isset($_GET['edit']) && !isset($_GET['delete']) && $_GET['page'] == 'menu') echo 'active'; ?>">
                    <i></i>
                    <a href="?page=menu">Menu</a>
                </li> 
            </ul>
        </nav>

        <div class="content-wrap">
            <div class="content">
                <?php if (isset($_GET['page'])): 
                    if ($_GET['page'] == 'sites'): ?> 
                        <h2>Twoje strony</h2>
                        <form class="display-pages">
                        <?php    
                            require 'inc/connection.inc.php';

                            $sql = 'SELECT * FROM pages';
                            $stmt = mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt, $sql)) {
                                
                                

                            } else {

                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                echo '<ol start="0"><li><div class="li-inside"><span>Nazwa strony</span><span>URI</span><span>ID</span><span>Akcje</span></div></li>';

                                while($row = mysqli_fetch_assoc($result)) {
                                
                                echo '<li><div class="li-inside"><span>'.$row['pageName'].'</span>
                                <span>/'.$row['pageURI'].'</span><span>'.$row['idPages'].'</span><span><button type="submit" name="edit" value="'.$row['idPages'].'">Edytuj</button>';if($row['idPages'] != 1) echo'<button class="accent" type="submit" name="delete" value="'.$row['idPages'].'">Usuń</button>'; echo '</span></div></li>';

                                }

                                echo '</ol>';

                                mysqli_stmt_close($stmt);
                                mysqli_close($conn);
                            
                            }
                            
                            ?>
                            </form>
                    <?php elseif($_GET['page'] == 'new') : ?>
                        <?php if (isset($_GET['error'])) {
                            if($_GET['error'] == 'emptyname') echo '<p class="message"><span class="ex-m">! </span>Uzupełnij nazwę strony</p>';
                            elseif ($_GET['error'] == 'sqlerror') echo '<p class="message"><span class="ex-m">! </span>Błąd połączenia z bazą danych</p>';
                            elseif ($_GET['error'] == 'nametaken') echo '<p class="message"><span class="ex-m">! </span>Strona o podanej nazwie już istnieje</p>';
                            
                        } elseif (isset($_GET['add']) && $_GET['add'] == 'success') echo '<p class="message">Pomyślnie dodano stronę</p>'; ?>
                        <h2>Dodaj stronę</h2>
                        <form class="editor" action="inc/add-page.inc.php" method="POST">
                        <input type="text" name="page-name" placeholder="Podaj nazwę nowej strony (widoczne w menu oraz CMS)">
                            <div class="friendly-url">
                                <span>
                                <?php echo $_SERVER['HTTP_HOST'] ?>/</span>
                                <input type="text" name="uri" placeholder="tutaj-wpisz-swoj-friendly-url">
                            </div>
                            <h3>Sekcja head</h3>
                            <span class="blue-code">&lt;head&gt;</span>
                            <div class="title-wrap">&lt;title&gt;<input type="text" name="title" placeholder="Tutaj wpisz title strony.">&lt;/title&gt;</div>
                            <div class="desc-wrap">&lt;meta <span class="tag">name</span>=<span class="accent">"descripton"</span> content=<span class="accent">"<textarea name="meta-desc" placeholder="Tutaj wpisz meta-opis strony."></textarea>"</span>&gt;</div>
                            <span class="blue-code">&lt;/head&gt;</span>
                            
                            <h3>Sekcja body</h3>
                            <div class="bold">Nagłówek h1: </div><input type="text" name="header" placeholder="Podaj treść nagłówka">
                            <div class="bold">Content:</div>
                            <textarea class="tinymce" name="content"></textarea>
                            <input type="submit" value="+" title="Dodaj stronę" name="page-submit">
                        </form>

                    <?php elseif($_GET['page'] == 'menu') : ?>

                        <h2>Edytuj pozycje menu</h2>
                        <form action="inc/menuOrder.inc.php" class="sort" method="POST">
                            <ol id="sortable">

                            <?php    
                            require 'inc/connection.inc.php';

                            $sql = 'SELECT pageName FROM menu ORDER BY menuOrder ASC';
                            $stmt = mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt, $sql)) {
                                
                                

                            } else {

                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                while($row = mysqli_fetch_assoc($result)) {

                                echo '<li><input type="text" name="menuElement[]" value="'.$row['pageName'].'"></li>';

                                }

                                mysqli_stmt_close($stmt);
                                mysqli_close($conn);
                            
                            }

                            ?>

                            </ol>
                            <input type="submit" value="Zapisz">
                        </form>

                    <?php endif; ?> 

                <?php endif;  ?>

                <?php 
                    if(isset($_GET['delete'])) {
                        require 'inc/connection.inc.php';

                            $sql = 'SELECT * FROM pages WHERE idPages=?';
                            $stmt = mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt, $sql)) {
                                
                                
                            } else {
                                
                                mysqli_stmt_bind_param($stmt, "s", $_GET['delete']);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                $row = mysqli_fetch_assoc($result);

                                $sql2 = 'DELETE FROM menu WHERE pageName=?';
                                $stmt2 = mysqli_stmt_init($conn);
                                mysqli_stmt_prepare($stmt2, $sql2);
                                mysqli_stmt_bind_param($stmt2, "s", $row['pageName']);
                                mysqli_stmt_execute($stmt2);

                                $sql = 'DELETE FROM pages WHERE idPages=?';
                                $stmt = mysqli_stmt_init($conn);
                                mysqli_stmt_prepare($stmt, $sql);
                                mysqli_stmt_bind_param($stmt, "s", $_GET['delete']);
                                mysqli_stmt_execute($stmt);

                                echo '<p class="message">Usunięto stronę</p>';
                            }
                    }
                ?>

                <?php if(isset($_GET['edit'])) : ?>
                        <?php if (isset($_GET['error'])) {
                            if($_GET['error'] == 'emptyname') echo '<p class="message"><span class="ex-m">! </span>Uzupełnij nazwę strony</p>';
                            elseif ($_GET['error'] == 'sqlerror') echo '<p class="message"><span class="ex-m">! </span>Błąd połączenia z bazą danych</p>';
                            elseif ($_GET['error'] == 'nametaken') echo '<p class="message"><span class="ex-m">! </span>Strona o podanej nazwie już istnieje</p>';
                            
                        } elseif (isset($_GET['edited']) && $_GET['edited'] == 'true') echo '<p class="message">Pomyślnie edytowano stronę</p>'; ?>
                        
                        <?php

                            require 'inc/connection.inc.php';

                            $sql = 'SELECT * FROM pages WHERE idPages=?';
                            $stmt = mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($stmt, $sql)) {
                                
                                

                            } else {
                                
                                mysqli_stmt_bind_param($stmt, "s", $_GET['edit']);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);

                                    $row = mysqli_fetch_assoc($result);

                                    

                            }

                        ?>
                        
                        
                        <h2>Edytuj stronę</h2>
                        <form class="editor" action="inc/edit-page.inc.php" method="POST">
                        <input type="text" name="page-name" placeholder="Podaj nazwę nowej strony (widoczne w menu oraz CMS)" value="<?php echo $row['pageName'] ?>">
                            <div class="friendly-url">
                                <span>
                                <?php echo $_SERVER['HTTP_HOST'] ?>/</span>
                                <?php if($row['idPages'] != 1) : ?>
                                <input type="text" name="uri" placeholder="tutaj-wpisz-swoj-friendly-url" value="<?php echo $row['pageURI'] ?>">
                                <?php endif; ?>
                            </div>
                            <h3>Sekcja head</h3>
                            <span class="blue-code">&lt;head&gt;</span>
                            <div class="title-wrap">&lt;title&gt;<input type="text" name="title" placeholder="Tutaj wpisz title strony." value="<?php echo $row['metaTitle'] ?>">&lt;/title&gt;</div>
                            <div class="desc-wrap">&lt;meta <span class="tag">name</span>=<span class="accent">"descripton"</span> content=<span class="accent">"<textarea name="meta-desc" placeholder="Tutaj wpisz meta-opis strony."><?php echo $row['metaDesc'] ?></textarea>"</span>&gt;</div>
                            <span class="blue-code">&lt;/head&gt;</span>
                            
                            <h3>Sekcja body</h3>
                            <div class="bold">Nagłówek h1: </div><input type="text" name="header" placeholder="Podaj treść nagłówka" value="<?php echo $row['pageHeader'] ?>">
                            <div class="bold">Content:</div>
                            <textarea class="tinymce" name="content"><?php echo $row['pageContent'] ?></textarea>
                            <input type="hidden" name="id" value="<?php echo $_GET['edit'] ?>">
                            <input type="submit" value="&check;" title="Edytuj stronę" name="page-submit">
                        </form>
                        <?php endif; ?>

            </div>
        </div>

    </div>

</div>


<script src="js/script.js"></script>
    <?php if((isset($_GET['page']) && $_GET['page'] == 'new') || isset($_GET['edit'])) : ?>
        <script src="plugins/tinymce/tinymce.min.js"></script>
        <script src="js/tinymce-config.js"></script>
    <?php elseif(isset($_GET['page']) && $_GET['page'] == 'menu') : ?>
        <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
        <script src="js/sort.js"></script>
    <?php endif;  ?>
</body>

</html>
<?php else : 
     header('Location: /admin/login/');
endif; 
?>

   



