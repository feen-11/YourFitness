<?php

require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/User.php');
require_once(__DIR__ . '/Post.php');
require_once(__DIR__ . '/InvalidToken.php');
require_once(__DIR__ . '/InvalidTimeflame.php');
require_once(__DIR__ . '/InvalidFood.php');
require_once(__DIR__ . '/InvalidIntakeCalorie.php');
require_once(__DIR__ . '/InvalidTraining.php');
require_once(__DIR__ . '/InvalidBurnCalorie.php');

class Index extends Controller {
  
  public function run() {
//     if (!$this->loginCheck()) {
//       // login
//       header('Location: ' . SITE_URL . '/login.php');
//       exit;
//     }
//     if (!$this->setUpCheck()) {
//       // setup
//       header('Location: ' . SITE_URL . '/setUp.php');
//       exit;
//     }
//     if (!$this->startCheck()) {
//       // start
//       header('Location: ' . SITE_URL . '/start.php');
//       exit;
//     }
  }

  public function readPosts(){
      $app = new Post();
      $posts = $app->readPost();
      return $posts;
  }

  public function readFoods(){
    $app = new Post();
      $posts = $app->readFood();
      return $posts;
  }

  public function readTrainings(){
    $app = new Post();
      $posts = $app->readTraining();
      return $posts;
  }

  public function readLoginTimes(){
    $app = new Model();
    return $app->getLoginDate();
  }

  public function totalIntakeCalorie(){
    $app = new Post();
    return $app->getTotalIntakeCalorie();
  }

  public function totalBurnCalorie(){
    $app = new Post();
    return $app->getTotalBurnCalorie();
  }




  }

  



?>
