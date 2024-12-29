<?php

    setcookie('Email', ' ', time() - 3600, '/');
    session_start();
    session_destroy();
    header("location: ./../../index.php");
    die();

?>