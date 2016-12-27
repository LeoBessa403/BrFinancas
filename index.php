<?php
    $url = (isset($_GET['url']) && $_GET['url'] != "" ? $_GET['url'] : "web");

    $url = explode("/", $url);

    if($url[0] == "admin"):
        include './admin/sistema.php';
    else:
        include './web/web.php';
    endif;
?>