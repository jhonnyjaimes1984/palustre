<?php
session_start();

session_destroy();

header("Location: ../admin/ingreso.php");
?>