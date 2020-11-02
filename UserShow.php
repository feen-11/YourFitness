
<?php

require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/User.php');


class UserShow extends Controller{

  public function run() {
    if (!$this->loginCheck()) {
      // login
      header('Location: ' . SITE_URL . '/login.php');
      exit;
    } 
  }
  
}
?>
