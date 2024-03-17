<?php
    $search = str_replace(" ","%20",$_POST["view"]);
    $content = file_get_contents("https://www.imdb.com/find/?q=" . $search . "&ref_=nv_sr_sm");
    echo "<script>$('.content').html(" . $content . ")</script>";
?>

<script>
    get_movie2()
</script>