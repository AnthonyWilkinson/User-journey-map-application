<?php

function makePageStart($metaName, $metaContent, $pageTitle, $background, $mainWidth)
{
    $pageStartContent = <<<PAGESTART
  <!DOCTYPE html>
  <html lang="en" class="$background">
  <head>
      <meta charset="UTF-8">
      <meta name="$metaName" content="$metaContent">
      <link rel="stylesheet" type="text/css" href="css/main.css">
      <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css" rel="stylesheet" type="text/css" />
      <script src="scripts/slider.js"></script>
      <script src="scripts/persona_edit.js"></script>
      <script src="scripts/project_overview.js"></script>
      <script src="scripts/userJourneyFunctions.js"></script>
      <title>$pageTitle</title>
  </head>
  <body >
    <main class='$mainWidth'>
PAGESTART;
    $pageStartContent .= "\n";
    return $pageStartContent;
}

function makeLoginPage($metaName, $metaContent, $pageTitle, $background)
{
    $pageStartContent = <<<PAGESTART
  <!DOCTYPE html>
  <html lang="en" class="$background">
  <head>
      <meta charset="UTF-8">
      <meta name="$metaName" content="$metaContent">
      <link rel="stylesheet" type="text/css" href="css/main.css">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">     
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="scripts/slider.js"></script>
      <script src="scripts/persona_edit.js"></script>
      <script src="scripts/project_overview.js"></script>
      <script src="scripts/userJourneyFunctions.js"></script>
      <title>$pageTitle</title>
  </head>
  <body >
PAGESTART;
    $pageStartContent .= "\n";
    return $pageStartContent;
}

function makeSidebar()
{
    $userID = $_SESSION['userID'];
    $makeSidebar = "
    <div id='mySidenav' class='sidenav'>
        <a href='./index.php'><img src='images/logo.png' style='width: 150px; height: 150px; margin-left:10%;'></a>
        <ul>
            <li><a href='./profile.php?userID=$userID'>My account</a></li>
            <li><a href='./index.php'>Projects</a></li>";
    if (isset($_SESSION['forename'])) {
        $makeSidebar .= "<li><a href='scripts/logout.php'>Logout</a></li>";
    }

    $makeSidebar .= "</ul>
    </div>";
    $makeSidebar .= "\n";
    return $makeSidebar;
}

function makePageFooter()
{
    $makePageFooter = <<<FOOTER
    </main>
</body>
</html>
FOOTER;
    $makePageFooter .= "\n";
    return $makePageFooter;
}


function startSession()
{
    ini_set("session.save_path", "/home/unn_w14011103/sessionData");
    session_start();
}

;