<?php

require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/Post.php');
require_once(__DIR__ . '/User.php');
require_once(__DIR__ . '/InvalidToken.php');
require_once(__DIR__ . '/InvalidTraining.php');
require_once(__DIR__ . '/InvalidBurnCalorie.php');


class EditTraining extends Controller{

  public function run(){
    if(!$this->loginCheck()){
      header('Location:' . SITE_URL . '/login.php');
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $this->editTrainingProcess();
    }
  }

  public function showTraining(){
    $app = new Post();
    $id = (int)$_GET['id'];
    $training = $app->readDetailedTraining($id);
    return $training;
  }

  public function editTrainingProcess(){
    try{
      $this->validate();
    }catch(InvalidToken $e){
      $this->setErrors('token', $e->getMessage());
    }catch(InvalidTraining $e){
      $this->setErrors('trainingName', $e->getMessage());
    }catch(InvalidBurnCalorie $e){
      $this->setErrors('burnCalorie', $e->getMessage());
    }
    $this->setValues('trainingName', $_POST['trainingName']);
    $this->setValues('burnCalorie', $_POST['burnCalorie']);


    if($this->hasError()){
      return;
    } else{
      $app = new Post();
      $id = (int)$_GET['id'];
      $app->editTraining($id);
      header('Location: ' . SITE_URL . '/index.php');
    }
  }

  public function validate(){
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      throw new InvalidToken();
    }

      if(empty($_POST['trainingName'])){
        throw new InvalidTraining();
      };

      if(empty($_POST['burnCalorie'])){
        throw new InvalidBurnCalorie();
      };
    }


  }


  

  
  

?>
