<?php
ob_start();
require_once('functions.php');
echo startSession();
require_once('../classes/databaseConn.php');
echo makePageStart("viewport", "width=device-width, inital-scale=1", "Update text", "", "");
echo makeSidebar();

$dbConn = databaseConn::getConnection();

$id = $_POST["id"];
$text = $_POST["text"];

$sql = "UPDATE CJ_feelings SET feelingDesc = :feelingDesc where feelingID = :feelingID ";
$query = $dbConn->prepare($sql);
$query->execute(array(':feelingDesc' => $text, ':feelingID' => $id));