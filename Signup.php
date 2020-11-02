<?php

require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/User.php');
require_once(__DIR__ . '/InvalidName.php');
require_once(__DIR__ . '/InvalidEmail.php');
require_once(__DIR__ . '/InvalidPassword.php');
require_once(__DIR__ . '/InvalidToken.php');
require_once(__DIR__ . '/ExistsEmail.php');


class Signup extends Controller{
  public function run(){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $this->signupProcess();
    }
  }
  
  public function signupProcess(){

    try{
      $this->validate();
    }catch(InvalidToken $e){
      $this->setErrors('token', $e->getMessage());
    }catch(InvalidEmail $e){
      $this->setErrors('email', $e->getMessage());
    }catch(InvalidName $e){
      $this->setErrors('name', $e->getMessage());
    }catch(InvalidPassword $e){
      $this->setErrors('password', $e->getMessage());
    }

    $this->setValues('email', $_POST['email']);
    $this->setValues('name', $_POST['name']);

    if($this->hasError()){
      return;
    } else{
        // create
        $user = new User();
        $user->userCreate();
        // redirect
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

    if (!preg_match('/\A[a-zA-Z0-9]+\z/', $_POST['password'])) {
      throw new InvalidPassword();
    }
  }
  
}
?>