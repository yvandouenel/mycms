<?php
require_once('standard/head.php');
?>
<?php
require_once('standard/header.php');
?>
    <main class="container">
        <h1>
            <?= $data["node"]->title; ?>
        </h1>

        <?php
        echo $data["node"]->body;
        ?>
    </main>

<?php
require_once('standard/footer.php');
?>