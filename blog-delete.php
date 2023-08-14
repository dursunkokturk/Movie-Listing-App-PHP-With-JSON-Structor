<?php

    require "libs/vars.php";
    require "libs/functions.php";

    $id = $_GET["id"];

    deleteBlog($id);

    $_SESSION['message'] = $id." id Numarali Film Silindi";
    $_SESSION['type'] = "danger";

    header('Location: admin-blogs.php');

?>