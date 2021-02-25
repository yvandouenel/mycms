<div class="bg-secondary p-4">
<footer class="container text-light ">
    Footer ici
    <?php if(isset($GLOBALS['infos']) && is_array($GLOBALS['infos']) && count($GLOBALS['infos'])) {
        echo '<div id="global-bubble">';
        foreach($GLOBALS['infos'] as $msg) {
            echo '<p class="bubble-' . $msg['type'] .' text-light p-3 mb-3">'. $msg['msg'] . '</p>';
        }
        echo '</div>';
    }

    ?>
</footer>
</div>
</body>
</html>