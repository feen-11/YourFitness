<?php

require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/User.php');
require_once(__DIR__ . '/InvalidName.php');
require_once(__DIR__ . '/InvalidEmail.php');
require_once(__DIR__ . '/InvalidHeight.php');
require_once(__DIR__ . '/InvalidWeight.php');
require_once(__DIR__ . '/InvalidAge.php');
require_once(__DIR__ . '/InvalidToken.php');
require_once(__DIR__ . '/InvalidBody.php');


class UserEdit extends Controller{

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
    }catch(InvalidName $e){
      $this->setErrors('name', $e->getMessage());
    }catch(InvalidEmail $e){
      $this->setErrors('email', $e->getMessage());
    }catch(InvalidHeight $e){
      $this->setErrors('height', $e->getMessage());
    }catch(InvalidWeight $e){
      $this->setErrors('weight', $e->getMessage());
    }catch(InvalidAge $e){
      $this->setErrors('age', $e->getMessage());
    }catch(InvalidBody $e){
      $this->setErrors('declaration', $e->getMessage());
    }
    $this->setValues('declaration', $_POST['declaration']);


    if($this->hasError()){
      return;
    } else{
      $app = new User();
      $app->userEdit();
      header('Location: SITE_URL');
    }
  }

  public function validate(){
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      throw new InvalidToken();
    }
    
    if($_POST['name'] === '' || mb_strlen($_POST['name']) > 10){
      throw new InvalidName();
    }

    if($_POST['email'] === '' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
      throw new InvalidEmail();
    }

    if($_POST['height'] === '' || $_POST['height'] > 250){
      throw new InvalidHeight();
    }

    if($_POST['weight'] === '' || $_POST['weight'] > 500){
      throw new InvalidWeight();
    }

    if($_POST['nowWeight'] === '' || $_POST['nowWeight'] > 500){
      throw new InvalidWeight();
    }
    if($_POST['goalWeight'] === '' || $_POST['goalWeight'] > 500){
      throw new InvalidWeight();
    }

    if($_POST['age'] === ''){
      throw new InvalidAge();
    }

    if(empty($_POST['declaration']) ||mb_strlen($_POST['declaration']) > 191){
      throw new InvalidBody();
    };


  }


  

  
  
}
?>