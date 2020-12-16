<?php

require_once(__DIR__ . '/../lib/Controller/ShowFood.php');
require_once(__DIR__ . '/../config/config.php');

$app = new ShowFood();
$app->run();

$food = $app->showFood();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= h($food['created'])?> <?= h($food['foodName'])?> - YourFitness</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="index wrap">
  <header class="header">
    <div class="container ">
      <div class="row d-flex align-items-center justify-content-between">
        <div class="header-left col-xs-12 col-md-6">
          <h2>YourFitness</h2>
        </div>
        <div class="header-right d-flex justify-content-end col-xs-12 col-md-6">
          <div class="login-user col-xs-8">
            <p><i class="fas fa-user"></i><a href="userShow.php"> <?= h($_SESSION['me']['name']) ?></a></p>
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

  <main class="mb-5">
  <div class="user-show">
      <div class="container">
        <div class="user-info container">
          <h2 class="text-center heading"><?= h($food['created'])?>：<?= h($food['foodName'])?>の詳細</h2>
          <div class="container user-info-show">
            <p class=""><i class="fas fa-utensils"></i>食べたもの：<?= h($food['foodName']) ?></p>
            <p><i class="far fa-clock"></i> 時間帯：<?= h($food['timeflame']) ?></p>
            <p><i class="fas fa-fire fa-lg"></i> カロリー：<?= h($food['calorie']) ?>kcal</p>
            <p><i class="fab fa-pagelines fa-lg"></i> 食べた日：<?= h($food['created']) ?></p>
            <div class="justify-content-center col-sm-12 col-md-6 mx-auto text-center">
              <a class="btn btn-primary edit-link" href="editFood.php?id=<?= $food['foodId']?>">編集する</a>
              <form action="" method="post" id="delete">
              <div class="btn-primary btn" onclick="document.getElementById('delete').submit();">削除</div>
              <input type="hidden" name="token" value="<?= h($_SESSION['token'])?>">
              </form>
              <a href="index.php" class="btn btn-primary">戻る</a>
            </div>
      </div>
          </div>
        </div>
      </div>
  </main>
</div>
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