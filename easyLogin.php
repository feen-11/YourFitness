<?php

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/User.php');

  $app = new User();
  $user = $app->easyLogin();
  $_SESSION['me'] = $user;
  $model = new Model();
  $model->postLoginDate();
  // redirect
  header('Location: ' . SITE_URL . '/index.php');

?>
