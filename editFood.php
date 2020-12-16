<?php

require_once(__DIR__ . '/../lib/Controller/EditFood.php');

$app = new EditFood();
$app->run();

$food = $app->showFood();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>編集- Fitness</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<header class="header">
    <div class="container ">
      <div class="row d-flex align-items-center justify-content-between">
        <div class="header-left col-xs-12 col-md-6">
          <h2>YourFitness</h2>
        </div>
        <div class="header-right d-flex justify-content-end col-xs-12 col-md-6">
          <div class="login-user col-xs-8">
            <p><i class="fas fa-user"></i><a href="userShow.php"> <?php echo $_SESSION['me']['name'] ?></a></p>
          </div>
          <div class="logout col-xs-4">
            <form action="logout.php" method="post" id="logout">
              <div class="btn-primary btn" onclick="document.getElementById('logout').submit();">ログアウト</div>
              <input type="hidden" name="token" value="<?= h($_SESSION['token'])?>">
            </form>
          </div>
        </div>
      </div>
    </div>
  </header>
  <main>
    <div class="user-edit">
      <div class="container">
        <div class="user-edit-form">
          <div class="text-center mx-auto col-sm-12 col-md-8">
          <h2 class="heading">食事の編集</h2>
            <p class="err"><?= h($app->getErrors('token'));?></p>
            <form action="" method="post" id="editFood">
              <div class="user-name-edit row justify-content-between">
                <p class="col-sm-12 col-md-4"><i class="fas fa-utensils"></i>食べたもの</p>
                <input class="col-sm-12 col-md-8" type="text" name="foodName" placeholder="食べたもの" value="<?= h($food['foodName']) ?>">
                <p class="err"><?= h($app->getErrors('food'));?></p>
              </div>
              <div class="user-email-edit row justify-content-between">
                <p class="col-sm-12 col-md-4"><i class="far fa-clock"></i> 時間帯</p>
                <input class="col-sm-12 col-md-8" type="text" name="timeflame" placeholder="時間帯" value="<?= h($food['timeflame']) ?>">
                <p class="err"><?= h($app->getErrors('timeflame'));?></p>
              </div>
              <div class="user-email-edit row justify-content-between">
                <p class="col-sm-12 col-md-4"><i class="fas fa-fire fa-lg"></i> カロリー</p>
                <input class="col-sm-12 col-md-8" type="text" name="intakeCalorie" placeholder="カロリー" value="<?= h($food['calorie']) ?>">
                <p class="err"><?= h($app->getErrors('intakeCalorie'));?></p>
              </div>
              
              <div class="justify-content-between col-sm-12 col-md-6 mx-auto">
                <div class="btn btn-primary" onclick="document.getElementById('editFood').submit();">更新</div>
                <input type="hidden" name="token" value="<?= h($_SESSION['token'])?>">
            </form>
              <a  class="btn btn-primary"href="index.php">戻る</a>
              </div>
              
          </div>
        </div>
      </div>
    </div>
  </main>
  <footer class="footer text-center  flex-column d-flex align-items-center justify-content-center">
    <div class="copyrights">
      <p>Copyright©️ YourFitness All Rights Reserved.</p>
      <p>Designed By Taichi Shiozawa</p>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>