<?php
require_once('standard/head.php');
require_once('standard/header.php');
// Session
if(!isset($_SESSION)) {
    if(!session_start()) echo "Problème de session";
}
?>
    <main class="container">
        <?php if(isset($_SESSION['login']) && $_SESSION['login'])  : ?>
        <section>
            <a href="/node/<?= $GLOBALS['data']->nid; ?>/edit">Modifier</a>
        </section>
        <?php endif ?>
        <?php if(isset($GLOBALS['data']->image) && !empty($GLOBALS['data']->image)) : ?>
            <img style="float:left; margin-right:20px; max-width:45%" src="<?php echo '/images/original/'. $GLOBALS['data']->image; ?>" alt=""/>
        <?php endif ?>
        <h1>
            <?= $GLOBALS['data']->title; ?>
        </h1>


        <?php
        echo $GLOBALS['data']->body;
        ?>
    </main>

<?php
require_once('standard/footer.php');
?>