<div class="bg-secondary p-4">
<footer class="container text-light ">
    Footer ici
    <?php if(isset($GLOBALS['info']['msg']) && !empty($GLOBALS['info']['msg'])) : ?>
    <p class="bubble-<?=$GLOBALS['info']['type']?> text-light p-3 d-inline-block"><?=$GLOBALS['info']['msg'] ?></p>
    <?php endif ?>

    <div>

    </div>
</footer>
</div>
</body>
</html>