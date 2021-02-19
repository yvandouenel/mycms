<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if(!empty($GLOBALS['data']->seo_title)) echo $GLOBALS['data']->seo_title;
        else echo $GLOBALS['data']->title;
        ?>
    </title>
</head>
<body>
<h1>
    <?= $GLOBALS['data']->title; ?>
</h1>
<main>
    <?php
    echo $GLOBALS['data']->body;
    ?>
</main>
</body>
</html>