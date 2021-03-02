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
        <h2>Derniers articles</h2>
        <section class="d-flex flex-wrap justify-content-between">

          <?php
          while($d = $data["list"]->fetch(PDO::FETCH_OBJ)) {
            echo '<article style="flex-basis: 30%;">';
            echo '  <h3><a href="/node/' . $d->nid . '">' . $d->title . '</a></h3>';
            echo '  <img style=" max-width:100%" src="' . '/images/original/'. $d->image . '" alt=""/>';
            echo '  <p>' . $d->summary . '</p>';
            echo '</article>';
          }

          ?>
        </section>
    </main>

<?php
require_once('standard/footer.php');
?>