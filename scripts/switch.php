<?php
    session_start();
    $selection = $_GET['selection'];
    $last = $_GET['last'];
    $_SESSION['selection'] = $selection;
                header("location: ../".$last.".php");
?>


