<?php
error_reporting(0);
session_start();

if($_SESSION["tipo"] != "A") {
    header("Location: /proyecto/inicio/index/");
    exit();
}

?>
