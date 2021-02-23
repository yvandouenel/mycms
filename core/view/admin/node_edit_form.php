<?php
require_once('../core/view/standard/head.php');

require_once('../core/view/standard/header.php');

if(!isset($_SESSION)) {
    if(!session_start()) echo "Problème de session";
}
?>
    <main class="container">
        <?php if(isset($_SESSION['login']) && $_SESSION['login'])  : ?>
            <section>
                <a href="/node/<?= $GLOBALS['data']->nid; ?>">Voir</a>
            </section>
        <?php endif ?>
        <h1 class="mt-4 mb-4">Modification d'un node</h1>
        <form enctype="multipart/form-data" action="/node/<?= $GLOBALS['data']->nid; ?>/edited" method="post" class="">
            <div class="form-group row">
                <label for="title" class="col-3">Titre</label>
                <input type="text" class="col-9" id="title" name="title" value="<?= $GLOBALS['data']->title; ?>">
            </div>
            <div class="form-group row">
                <label for="seo_title" class="col-3">Titre pour le référencement</label>
                <input type="text" class="col-9" id="seo_title" name="seo_title" value="<?= $GLOBALS['data']->seo_title; ?>">
            </div>
            <div class="form-group row">
                <label for="body" class="col-3">Corps</label>
                <textarea id="body" class="col-9" name="body"><?= $GLOBALS['data']->body; ?></textarea>
            </div>
            <div class="form-group row">
                <label for="path" class="col-3">Chemin</label>
                <input type="text" class="col-9" id="path" name="path" value="<?= $GLOBALS['data']->path; ?>">
            </div>
            <div class="form-group row">
                <label for="image" class="col-3">Image</label>
                <input type="file" name="image" id="userfile" accept="image/x-png,image/gif,image/jpeg" />
                <?php if(isset($GLOBALS['data']->image) && !empty($GLOBALS['data']->image)) : ?>
                    <img src="/images/original/<?= $GLOBALS['data']->image; ?>" alt="" style="max-width: 30%;" />
                <?php endif ?>
            </div>
            <!-- Champ caché -->
            <input type="hidden" name="nid" value="<?= $GLOBALS['data']->nid; ?>">

            <input type="submit" value="Envoyer" class="btn btn-primary mb-2">
        </form>
    </main>

<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../core/view/standard/footer.php');
?>