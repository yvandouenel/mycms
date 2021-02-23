<?php
require_once('../core/view/standard/head.php');
?>
<?php
require_once('../core/view/standard/header.php');
?>
    <main class="container">
        <h1 class="mt-4 mb-4">Formulaire d'identification</h1>
        <form enctype="multipart/form-data" action="/login" method="post" class="">
            <div class="form-group row">
                <label for="login" class="col-3">Login</label>
                <input type="text" class="col-9" id="login" name="login" >
            </div>
            <div class="form-group row">
                <label for="pwd" class="col-3">Mot de passe</label>
                <input type="password" class="col-9" id="pwd" name="pwd">
            </div>

            <input type="submit" value="Envoyer" class="btn btn-primary mb-2">
        </form>
    </main>

<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/../core/view/standard/footer.php');
?>