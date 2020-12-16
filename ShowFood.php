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

class ShowFood extends Controller {
  
  public function run() {
    if (!$this->loginCheck()) {
      // login
      header('Location: ' . SITE_URL . '/login.php');
      exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $this->deleteFood();
      header('Location: ' . SITE_URL . '/index.php');
    }
  }

  public function showFood(){
    $app = new Post();
    $id = (int)$_GET['id'];
    $food = $app->readDetailedFood($id);
    return $food;
  }

  public function deleteFood(){
    $app = new Post();
    $id = (int)$_GET['id'];
    $app->deleteFood($id);
  }

  }

  



?>
