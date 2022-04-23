<!DOCTYPE html>
<html lang="pl">

<?php if(isset($_GET['connection']) && $_GET['connection'] == 'failed') : ?>
    <title>Connection failed</title>
    <meta name="robots" content="noindex">
    <body><h1>Connection failed</h1><body>

<?php else : ?>

<?php @include_once('templates/head.php'); ?>

    <body>

        <div class="content-wrap">

            <?php @include_once('templates/menu.php'); ?>

            <header class="article-header">
                <h1><?php echo $row['pageHeader'] ?></h1>
            </header>

            <section class="content">

                <div class="article">
                
                    <?php echo $row['pageContent'] ?>

                </div>

            </section>

        <?php @include_once('templates/footer.php'); ?>


        
        <script src="js/script.js"></script>
    </body>

<?php endif;  ?>

</html>