<?php

require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/User.php');
require_once(__DIR__ . '/Post.php');
require_once(__DIR__ . '/InvalidEmail.php');
require_once(__DIR__ . '/InvalidPassword.php');
require_once(__DIR__ . '/InvalidToken.php');
require_once(__DIR__ . '/ExistsEmail.php');
require_once(__DIR__ . '/UnmatchEmailOrPassword.php');

class Login extends Controller{

  public function run(){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $this->loginProcess();
    }
  }

  public function loginProcess(){
    
    try{
      $this->validate();
    }catch(InvalidToken $e){
      $this->setErrors('token', $e->getMessage());
    }catch(InvalidEmail $e){
      $this->setErrors('email', $e->getMessage());
    }catch(InvalidPassword $e){
      $this->setErrors('password', $e->getMessage());
    }
    // login
    $this->setValues('email', $_POST['email']);
    if($this->hasError()){
      return;
    } else{
      try{
        // login
        $app = new User();
        $user = $app->login();
        $_SESSION['me'] = $user;
        $model = new Model();
        $model->postLoginDate();
        $sample = new Post();
        $sample->postFoodSample();
        $sample->postTrainingSample();
        // redirect
        header('Location: SITE_URL');
      }catch(UnmatchEmailOrPassword $e){
        $this->setErrors('unmatch', $e->getMessage());
      }
    }
  }

  public function validate(){
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      throw new InvalidToken();
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