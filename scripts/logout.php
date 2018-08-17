<?php
require_once('functions.php');
echo startSession();

$_SESSION = array();

session_destroy();

header('location: ../login.php');
exit;