<?php
require_once('standard/head.php');
?>
<?php
require_once('standard/header.php');
?>
    <main class="container">
        <h1>
            <?= $data->title; ?>
        </h1>

        <?php
        echo $data->body;
        ?>
    </main>

<?php
require_once('standard/footer.php');
?>