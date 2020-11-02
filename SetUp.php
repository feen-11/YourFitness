<?php

require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/User.php');
require_once(__DIR__ . '/Post.php');
require_once(__DIR__ . '/InvalidHeight.php');
require_once(__DIR__ . '/InvalidWeight.php');
require_once(__DIR__ . '/InvalidToken.php');
require_once(__DIR__ . '/InvalidSex.php');
require_once(__DIR__ . '/InvalidAge.php');


class SetUp extends Controller{

  public function run(){
    if (!$this->loginCheck()) {
      // login
      header('Location: ' . SITE_URL . '/login.php');
      exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $this->setUpProcess();
    }
  }

  public function setUpProcess(){
    // validate()
    try{
      $this->validate();
    }catch(InvalidToken $e){
      $this->setErrors('token', $e->getMessage());
    }catch(InvalidSex $e){
      $this->setErrors('sex', $e->getMessage());
    }catch(InvalidAge $e){
      $this->setErrors('age', $e->getMessage());
    }catch(InvalidHeight $e){
      $this->setErrors('height', $e->getMessage());
    }catch(InvalidWeight $e){
      $this->setErrors('weight', $e->getMessage());
    }

    $this->setValues('age', $_POST['age']);
    $this->setValues('height', $_POST['height']);
    $this->setValues('weight', $_POST['weight']);

    if($this->hasError()){
      return;
    } else{
      // setup
      $app = new User();
      $app->setUp();
      // update LoginDate
      $model = new Model();
      $model->postLoginDate();
      // insert sample
      $sample = new Post();
      $sample->postFoodSample();
      $sample->postTrainingSample();
      // redirect
      header('Location: ' . SITE_URL . '/start.php');
    }
  }

  // validate
  public function validate(){
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      throw new InvalidToken();
    }
    if($_POST['sex'] === '' || empty($_POST['sex'])){
      throw new InvalidSex();
    }
    if($_POST['age'] === '' || empty($_POST['sex']) || $_POST['sex'] > 150){
      throw new InvalidAge();
    }
    
    if($_POST['height'] === '' || $_POST['height'] > 250){
      throw new InvalidHeight();
    }

    if($_POST['weight'] === '' || $_POST['weight'] > 500){
      throw new InvalidWeight();
    }

  }


  

  
  
}
?>