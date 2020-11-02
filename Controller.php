<?php

class Controller {

  public $errors;
  public $values;

  public function __construct(){
    if (!isset($_SESSION['token'])) {
      $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
    }
    $this->errors = new \stdClass();
    $this->values = new \stdClass();
  } 

  public function generateMetabolism(){
    if($_SESSION['me']['sex'] === '男性'){
      $metabo = round(13.397 * $_SESSION['me']['nowWeight'] + 4.799 * $_SESSION['me']['height'] - 5.677 *  $_SESSION['me']['age'] +  88.362, 0);
      return $metabo;
    }elseif($_SESSION['me']['sex'] === '女性'){
      $metabo = round(9.247 * $_SESSION['me']['nowWeight'] + 3.098 * $_SESSION['me']['height'] - 4.33 * $_SESSION['me']['age'] + 447.593, 0);
      return $metabo;
    }
  }

  protected function loginCheck() {
    return isset($_SESSION['me']) && !empty($_SESSION['me']);
  }
  protected function setUpCheck() {
    return isset($_SESSION['me']['weight']) && !empty($_SESSION['me']['weight']);
  }
  protected function startCheck() {
    return isset($_SESSION['me']['goalWeight']) && !empty($_SESSION['me']['goalWeight']);
  }

  protected function setErrors($key, $error) {
    $this->errors->$key = $error;
  }

  public function getErrors($key) {
    return isset($this->errors->$key) ?  $this->errors->$key : '';
  }
  
  protected function hasError() {
    return !empty(get_object_vars($this->errors));
  }
  
  protected function setValues($key, $value) {
    $this->values->$key = $value;
  }

  public function getValues() {
      return $this->values;
  }
}