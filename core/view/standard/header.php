<?php if(isset($_SESSION['login']) && $_SESSION['login'])  : ?>
<div style="background-color: black">
    <ul class="list-unstyled d-flex justify-content-end m-0">
        <?php
        foreach ($GLOBALS["admin_menu"] as $key => $content) {
            echo '<li><a class="text-light p-2 d-block" href=" ' . $content["path"] . '">' . $content["label"] . '</a></li>';
        }
        ?>
    </ul>
</div>

<?php endif ?>

<div class="bg-secondary p-3">
    <header class="container text-light">
        <?php if(!isset($_SESSION['login']))  : ?>
            <section style="float: right;">
                <a class="text-light" href="/login">Identification</a>
            </section>
        <?php endif ?>
        <a class="text-light" href="/">En-tête avec le logo et le menu principal</a>
    </header>

</div>
