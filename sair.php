<?php
    $_SESSION["logado"] = null;
    session_destroy();
    header("location:index.php");
?>