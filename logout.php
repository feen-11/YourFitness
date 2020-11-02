
<?php

require_once(__DIR__ . '/config.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){

  if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
    echo "Invalid Token!";
    exit;
  }
  
  $_SESSION = [];
  session_destroy();
}

header('Location:' . SITE_URL);





?>