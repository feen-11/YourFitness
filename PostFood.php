<?php

require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/User.php');
require_once(__DIR__ . '/Post.php');
require_once(__DIR__ . '/InvalidToken.php');
require_once(__DIR__ . '/InvalidTimeflame.php');
require_once(__DIR__ . '/InvalidFood.php');
require_once(__DIR__ . '/InvalidIntakeCalorie.php');

class PostFood extends Controller {
  
  public function run() {
    if (!$this->loginCheck()) {
      // login
      header('Location: ' . SITE_URL . '/login.php');
      exit;
    }
    if (!$this->setUpCheck()) {
      // setup
      header('Location: ' . SITE_URL . '/setUp.php');
      exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $this->postProcess();
    }
  }

    public function postProcess(){

      // food
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
          // valueのセット
            $this->setValues('foodName', $_POST['foodName']);
            $this->setValues('intakeCalorie', $_POST['intakeCalorie']);
            
          if($this->hasError()){
            return;
          }
          else{
            $app = new Post();
            $app->postFood();
          }  
        // redirect
        header('Location: ' . SITE_URL . '/index.php');
        exit;
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
