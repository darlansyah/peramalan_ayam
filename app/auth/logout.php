<?php
include_once '../../functions/functions.php';
$waktu = date('Y-m-d H:i:s');
waktu_logout($_SESSION['id'],$waktu);
$_SESSION = [];
session_unset();
session_destroy();

header("location:index.php");
