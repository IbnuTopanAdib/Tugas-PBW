<?php
require('connect_db.php');
$_SESSION = [];
session_unset();
session_destroy();
header("Location: login.php")
?>