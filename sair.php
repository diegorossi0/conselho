<?php
    $_SESSION["logado"] = null;
    session_destroy();
    headr("location:index.php");
?>