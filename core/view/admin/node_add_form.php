<?php
require_once('../core/view/standard/head.php');

require_once('../core/view/standard/header.php');

if (!isset($_SESSION)) {
    if (!session_start()) echo "Problème de session";
}
?>
    <main class="container">
        <?php if (isset($_SESSION['login']) && $_SESSION['login'])  : ?>
            <h1 class="mt-4 mb-4">Ajout d'un node</h1>
            <form enctype="multipart/form-data" action="/node/add" method="post"
                  class="">
                <div class="form-group row">
                    <label for="title" class="col-3">Titre</label>
                    <input type="text" class="col-9" id="title" name="title" >
                </div>
                <div class="form-group row">
                    <label for="seo_title" class="col-3">Titre pour le référencement</label>
                    <input type="text" class="col-9" id="seo_title" name="seo_title">
                </div>
                <div class="form-group row">
                    <label for="body" class="col-3">Corps</label>
                    <textarea id="body" class="col-9" name="body"></textarea>
                </div>
                <div class="form-group row">
                    <label for="path" class="col-3">Chemin</label>
                    <input type="text" class="col-9" id="path" name="path" >
                </div>
                <div class="form-group row">
                    <label for="image" class="col-3">Image</label>
                    <input type="file" name="image" id="userfile" accept="image/x-png,image/gif,image/jpeg"/>

                </div>

                <input type="submit" value="Envoyer" class="btn btn-primary mb-2">
            </form>
        <?php endif ?>

    </main>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../core/view/standard/footer.php');
?>