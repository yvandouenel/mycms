<?php
require_once(__DIR__.'/../standard/head.php');
require_once(__DIR__.'/../standard/header.php');

// Session
if(!isset($_SESSION)) {
    if(!session_start()) echo "Problème de session";
}
?>
    <main class="container">

        <?php if(isset($_SESSION['login']) && $_SESSION['login'])  : ?>
        <h2>Liste des nodes</h2>
        <h3><a href="/node/add">+ Ajouter un node</a></h3>
        <table class="table">
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>Actions</th>
            </tr>

            <?php
            while($d = $data["list"]->fetch(PDO::FETCH_OBJ)) {
                echo '<tr>';
                echo '  <td> ' . $d->nid . '</td>';
                echo '  <td><a href="/node/' . $d->nid . '">' . $d->title . '</a></td>';
                echo '  <td><a href="/node/' . $d->nid . '/edit">Modifier</a> - <a href="/node/' . $d->nid . '/delete">Supprimer</a></td>';
                echo '</tr>';
            }

            ?>
        </table>
        <?php endif ?>
    </main>

<?php
require_once(__DIR__.'/../standard/footer.php');
?>