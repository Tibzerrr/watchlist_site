<?php
    $url = $_POST['url'];
    $content = file_get_contents($url);
    echo "<script>$('.content').html(" . $content . ")</script>";
?>