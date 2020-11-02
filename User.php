<?php

require_once(__DIR__ . '/Model.php');
require_once(__DIR__ . '/ExistsEmail.php');
require_once(__DIR__ . '/UnmatchEmailOrPassword.php');

class User extends Model{

  public function userCreate(){
      $db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
  $db['dbname'] = ltrim($db['path'], '/');
  $dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8";
  $user = $db['user'];
  $password = $db['pass'];
  $options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY =>true,
  );
  $pdo = new PDO($dsn,$user,$password,$options);
      $sql = "insert into users (email, name, password, created, updated) values (:email, :name, :password, now(), now())";
      $stmt = $pdo->prepare($sql);
      $res = $stmt->execute([
        ':email' => $_POST['email'],
        ':name' => $_POST['name'],
        ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
      ]);
  }

  public function login(){
    $sql = 'select * from users where email = :email';
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':email' => $_POST['email']
    ]); 
    $user = $stmt->fetch(\PDO::FETCH_ASSOC);
      if(password_verify($_POST['password'],$user['password'])){
        return $user;
      }else{
        throw new UnmatchEmailOrPassword();
      }
  }

  public function setUp(){
    // $age = $_POST['age'];
    // $height = $_POST['height'];
    // $weight = $_POST['weight'];
    // $userId = $_SESSION['me']['userId'];
    $sql = "update users set age = :age, sex = :sex, height = :height, weight = :weight, nowWeight =     :nowWeight, updated = now() where userId = :userId";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':age' => $_POST['age'],
      ':sex' => $_POST['sex'],
      ':height' => $_POST['height'],
      ':weight' => $_POST['weight'],
      ':nowWeight' => $_POST['weight'],
      ':userId' => $_SESSION['me']['userId']
    ]);

    // セッションの更新
    $this->updateSESSION();

  }

  public function setGoal(){
    $sql = 'update users set declaration = :declaration, goalWeight = :goalWeight, updated = now() where userId = :userId';
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':declaration' => $_POST['declaration'],
      ':goalWeight' => $_POST['goalWeight'],
      ':userId' => $_SESSION['me']['userId']
    ]);

    // セッションの更新
    $this->updateSESSION();
    }

  public function postWeight(){
    $sql = "update users set nowWeight = :nowWeight, updated = now() where userId = :userId";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':nowWeight' => $_POST['nowWeight'],
      ':userId' => $_SESSION['me']['userId']
    ]);
    // セッションの更新
    $this->updateSESSION();
    $model = new Model();
    $model->postLoginDate();
  }
  

  public function userEdit(){
    $sql = "update users set name = :name, email = :email, age = :age, height = :height, weight = :weight, nowWeight = :nowWeight, goalWeight = :goalWeight, declaration = :declaration, updated = now() where userId = :userId";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':name' => $_POST['name'],
      ':email' => $_POST['email'],
      ':age' => $_POST['age'],
      ':height' => $_POST['height'],
      ':weight' => $_POST['weight'],
      ':nowWeight' => $_POST['nowWeight'],
      ':goalWeight' => $_POST['goalWeight'],
      ':declaration' => $_POST['declaration'],
      ':userId' => $_SESSION['me']['userId']
    ]);
    // セッションの更新
    $this->updateSESSION();
    $model = new Model();
    $model->postLoginDate();
  }

  public function postUser($userId){
    $sql = "select name from users where userId = :userId";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':userId' => $userId
    ]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  public function updateSESSION(){
    $sql = "select * from users where userId = :userId";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':userId' => $_SESSION['me']['userId']
    ]);
    $user = $stmt->fetch(\PDO::FETCH_ASSOC);
    $_SESSION['me'] = $user;
  }


} 
?>
