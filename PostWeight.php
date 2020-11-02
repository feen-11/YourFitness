<?php

require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/User.php');
require_once(__DIR__ . '/InvalidWeight.php');
require_once(__DIR__ . '/InvalidToken.php');


class PostWeight extends Controller{

  public function run(){
    if(!$this->loginCheck()){
      header('Location:' . SITE_URL . '/login.php');
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $this->userEditProcess();
    }
  }

  public function userEditProcess(){
    try{
      $this->validate();
    }catch(InvalidToken $e){
      $this->setErrors('token', $e->getMessage());
    }catch(InvalidWeight $e){
      $this->setErrors('nowWeight', $e->getMessage());
    }


    if($this->hasError()){
      return;
    } else{
      $app = new User();
      $app->postWeight();
      header('Location: ' . SITE_URL . '/index.php');
    }
  }

  public function validate(){
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      throw new InvalidToken();
    }

    if($_POST['nowWeight'] === '' || $_POST['nowWeight'] > 500){
      throw new InvalidWeight();
    }
  }


  

  
  
}
?>
