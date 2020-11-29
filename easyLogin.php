<?php

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/User.php');
require_once(__DIR__ . '/Post.php');

  $app = new User();
  $user = $app->easyLogin();
  $_SESSION['me'] = $user;
  $model = new Model();
  $model->postLoginDate();
  $sample = new Post();
  $sample->postFoodSample();
  $sample->postTrainingSample();
  // redirect
  header('Location: ' . SITE_URL . '/index.php');

?>
