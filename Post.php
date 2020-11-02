<?php

require_once(__DIR__ . '/Model.php');
require_once(__DIR__ . '/User.php');

class Post extends Model{
  
  public function postFood(){
    $sql = "insert into food (timeflame, foodName, calorie, created, updated, userId) values (:timeflame, :foodName, :calorie, now(), now(), :userId)";
      $stmt = $this->dbh->prepare($sql);
      $res = $stmt->execute([
        ':timeflame' => $_POST['timeflame'],
        ':foodName' => $_POST['foodName'],
        ':calorie' => $_POST['intakeCalorie'],
        ':userId' => $_SESSION['me']['userId']
      ]);
  }
  public function postTraining(){
    $sql = "insert into training (trainingName, burnCalorie, created, updated ,userId) values (:trainingName, :burnCalorie, now(), now(), :userId)";
      $stmt = $this->dbh->prepare($sql);
      $res = $stmt->execute([
        ':trainingName' => $_POST['training'],
        ':burnCalorie' => $_POST['burnCalorie'],
        ':userId' => $_SESSION['me']['userId']
      ]);
  }
  public function postBody(){
    $res = $this->checkTodayPost();
    if($res === false){
      $sql = "insert into posts (body, created, updated, userId) values (:body, now(), now(), :userId)";
      $stmt = $this->dbh->prepare($sql);
      $res = $stmt->execute([
        ':body' => $_POST['body'],
        ':userId' => $_SESSION['me']['userId']
      ]);
    }
    else{
      $sql = "update posts set body = :body, updated = now() where postId = :postId";
        $stmt = $this->dbh->prepare($sql);
        $res = $stmt->execute([
          ':body' => $_POST['body'],
          ':postId' => $res['postId']
        ]);
    }
  }

  public function readPost(){
      $sql = "select * from posts where userId = :userId";
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute([
        ':userId' => $_SESSION['me']['userId']
      ]);
      return $posts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
  public function readFood(){
      $sql = "select * from food where userId = :userId";
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute([
        ':userId' => $_SESSION['me']['userId']
      ]);
      return $posts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
  public function readTraining(){
      $sql = "select * from training where userId = :userId";
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute([
        ':userId' => $_SESSION['me']['userId']
      ]);
      return $posts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function checkTodayPost(){
    $sql = "select * from posts where created = :date and userId = :userId";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':date' => date('Y-m-d'),
      ':userId' => $_SESSION['me']['userId']
    ]);
    $res = $stmt->fetch(\PDO::FETCH_ASSOC);
      return $res;
  }

  public function getTotalIntakeCalorie(){
    $sql = "select sum(calorie) as totalIntakeCalorie, created from food  where userId = :userId group by created order by created desc ";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':userId' => $_SESSION['me']['userId']
    ]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
  public function getTotalBurnCalorie(){
    $sql = "select sum(burnCalorie) as totalBurnCalorie, created from training  where userId = :userId group by created order by created desc ";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':userId' => $_SESSION['me']['userId']
    ]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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

  public function postFoodSample(){
    $res = $this -> checkFoodSample();
    if($res === false){
      $sql = "insert into food (foodName, calorie, created, updated, userId) values ('', 0, now(), now(), :userId)";
        $stmt = $this->dbh->prepare($sql);
        $res = $stmt->execute([
          ':userId' => $_SESSION['me']['userId']
        ]);
    }else{
      return;
    }
  }
  public function postTrainingSample(){
    $res = $this -> checkTrainingSample();
    if($res === false){
      $sql = "insert into training (trainingName, burnCalorie, created, updated ,userId) values ('', 0, now(), now(), :userId)";
        $stmt = $this->dbh->prepare($sql);
        $res = $stmt->execute([
          ':userId' => $_SESSION['me']['userId']
        ]);
    }
    else{
      return;
    }

  }


  public function checkFoodSample(){
    $sql = "select foodName from food where foodName = '' and created = :created and userId = :userId ";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':created' => date('Y-m-d'),
      ':userId' => $_SESSION['me']['userId']
      ]);
    $res = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $res;
  }

  public function checkTrainingSample(){
    $sql = "select trainingName from training where trainingName = '' and created = :created and userId = :userId ";
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([
      ':created' => date('Y-m-d'),
      ':userId' => $_SESSION['me']['userId']
      ]);
    $res = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $res;
  }

} 
?>