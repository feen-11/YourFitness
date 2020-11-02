
<?php

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/functions.php');


class Model{
  public $dbh;
  public function __construct(){
    try {
      $this->dbh = new \PDO(DSN, DB_USERNAME, DB_PASSWORD);
      $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    } catch (\PDOException $e) {
      echo $e->getMessage();
      exit;
    }
  }
  
  public function checkLoginDate(){
    $sql = "select loginDay from logindateinfo where loginDay = :loginDay and userId = :userId ";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':loginDay' => date('Y-m-d'),
      ':userId' => $_SESSION['me']['userId']
      ]);
    $res = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $res;
  }

  public function postLoginDate(){
    $res = $this -> checklogindate();
    if($res === false){
      $sql = "insert into logindateInfo (loginDay, dayWeight, userId) values (:loginDay, :dayWeight, :userId)";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':loginDay' => date('Y-m-d'),
      ':dayWeight' => $_SESSION['me']['nowWeight'],
      ':userId' => $_SESSION['me']['userId']
      ]);
    }
    else{
      $sql = "update logindateinfo set dayWeight = :nowWeight  where loginDay = :loginDay and userId = :userId";
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute([
        ':nowWeight' => $_SESSION['me']['nowWeight'],
        ':loginDay' => date('Y-m-d'),
        ':userId' => $_SESSION['me']['userId']
        ]);
    }
  }

    public function getLoginDate(){
      $sql = "select * from logindateinfo where userId = :userId order by loginDay desc";
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute([
        ':userId' => $_SESSION['me']['userId']
        ]);
      return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
    
    

?>