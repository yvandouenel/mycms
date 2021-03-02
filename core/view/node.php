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
              <a href="/node/<?= $data["node"]->nid; ?>/edit">Modifier</a>

          </section>
      <?php endif ?>
      <?php if(isset($data["node"]->image) && !empty($data["node"]->image)) : ?>
          <img style="float:left; margin-right:20px; max-width:45%" src="<?php echo '/images/original/'. $data["node"]->image; ?>" alt=""/>
      <?php endif ?>
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