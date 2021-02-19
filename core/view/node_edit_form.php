<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modification d'un node</title>
</head>
<body>
<h1>Modification d'un node</h1>
<form action="/node/<?= $GLOBALS['data']->nid; ?>/edited" method="post">
    <label for="title">Titre</label>
    <input type="text" id="title" name="title" value="<?= $GLOBALS['data']->title; ?>">
    <label for="seo_title">Titre pour le référencement</label>
    <input type="text" id="seo_title" name="seo_title" value="<?= $GLOBALS['data']->seo_title; ?>">
    <label for="body">Corps</label>
    <textarea id="body" name="body"><?= $GLOBALS['data']->body; ?></textarea>
    <label for="path">Chemin</label>
    <input type="text" id="path" name="path" value="<?= $GLOBALS['data']->path; ?>">

    <!-- Champ caché -->
    <input type="hidden" name="nid" value="<?= $GLOBALS['data']->nid; ?>">

    <input type="submit" value="Envoyer">
</form>
</body>
</html>