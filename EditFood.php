<?php

require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/Post.php');
require_once(__DIR__ . '/User.php');
require_once(__DIR__ . '/InvalidToken.php');
require_once(__DIR__ . '/InvalidTimeflame.php');
require_once(__DIR__ . '/InvalidFood.php');
require_once(__DIR__ . '/InvalidIntakeCalorie.php');


class EditFood extends Controller{

  public function run(){
    if(!$this->loginCheck()){
      header('Location:' . SITE_URL . '/login.php');
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $this->editFoodProcess();
    }
  }

  public function showFood(){
    $app = new Post();
    $id = (int)$_GET['id'];
    $food = $app->readDetailedFood($id);
    return $food;
  }

  public function editFoodProcess(){
    try{
      $this->validate();
    }catch(InvalidToken $e){
      $this->setErrors('token', $e->getMessage());
    }catch(InvalidTimeflame $e){
      $this->setErrors('timeflame', $e->getMessage());
    }catch(InvalidFood $e){
      $this->setErrors('food', $e->getMessage());
    }catch(InvalidIntakeCalorie $e){
      $this->setErrors('intakeCalorie', $e->getMessage());
    }
    $this->setValues('foodName', $_POST['foodName']);
    $this->setValues('timeflame', $_POST['timeflame']);
    $this->setValues('intakeCalorie', $_POST['intakeCalorie']);


    if($this->hasError()){
      return;
    } else{
      $app = new Post();
      $id = (int)$_GET['id'];
      $app->editFood($id);
      header('Location: ' . SITE_URL . '/index.php');
    }
  }

  public function validate(){
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      throw new InvalidToken();
    }
      
      if(empty($_POST['timeflame'])){
        throw new InvalidTimeflame();
      };

      if(empty($_POST['foodName'])){
        throw new InvalidFood();
      };

      if(empty($_POST['intakeCalorie'])){
        throw new InvalidIntakeCalorie();
      };

  }


  }


  

  
  

?>
