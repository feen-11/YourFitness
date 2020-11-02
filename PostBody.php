<?php

require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/User.php');
require_once(__DIR__ . '/Post.php');
require_once(__DIR__ . '/InvalidToken.php');
require_once(__DIR__ . '/InvalidBody.php');


class PostBody extends Controller {
  
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

      try{
        $this->validate();
      }catch(InvalidToken $e){
        $this->setErrors('token', $e->getMessage());
      }catch(InvalidBody $e){
        $this->setErrors('body', $e->getMessage());
      }

      $this->setValues('body', $_POST['body']);
          if($this->hasError()){
            return;
          }
          else{
            $app = new Post();
            $app->postBody();
          }  
        // redirect
        header('Location: ' . SITE_URL . '/index.php');
        exit;
    }
    

    public function validate(){
      if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
        throw new InvalidToken();
      }
  
        if(empty($_POST['body']) ||mb_strlen($_POST['body']) > 191){
          throw new InvalidBody();
        };
  
      }

      public function checkPost(){
        $app = new Post();
        $post = $app->checkTodayPost();
        return $post;
      }

  }

  



?>
