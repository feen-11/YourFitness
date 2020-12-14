<?php

require_once(__DIR__ . '/SetUp.php');

$app = new SetUp();
$app->run();

$err = $app->getErrors('height');

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>身体情報の設定 - YourFitness</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="setUp"> 
  <header class="header">
    <div class="container ">
      <div class="row d-flex align-items-center justify-content-between">
        <div class="header-left col-xs-12 col-md-6">
          <h2>YourFitness</h2>
        </div>
        <div class="header-right d-flex justify-content-end col-xs-12 col-md-6">
          <div class="login-user col-xs-8">
            <li><i class="fas fa-user"></i><a href="userShow.php"> <?= h($_SESSION['me']['name']) ?></a></li>
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
    <div class="container setUp-part mx-auto text-center">
      <div class="setUp-title text-center">
        <h2 class="heading">身体情報の設定</h2>
        <!-- <p>Physical information</p> -->
        <p class="description">始めに身長や体重、年齢を設定して今後の記録の指針を決めよう。</p>
        <p></p>
        <p class="caption">※小数点以下は自動的に四捨五入されます。</p>
      </div>
      <div class="setUp-form text-center">
        <form action="" id="setup" method="post">
          <p class="err"><?= h($app->getErrors('token'));?></p>
          <div class="sex-info">
                <p><i class="fas fa-restroom fa-lg"></i> 性別</p>    
                <input type="radio" value="男性" name="sex">男性
                <input type="radio" value="女性" name="sex">女性
              <p class="err"><?= h($app->getErrors('sex'));?></p>
          </div>
          <div class="row age d-flex justify-content-center">
            <p class="col-6"><i class="fab fa-pagelines fa-lg"></i> 年齢</p>
            <input class="col-md-6" type="text" placeholder="年齢(数値)" name="age" value="<?= isset($app->getValues()->age) ? h($app->getValues()->age) : '' ?>">
            <p class="err"><?= h($app->getErrors('age'));?></p>
          </div>
          <div class="height row d-flex justify-content-center">
            <p class="col-md-6"><i class="fas fa-arrow-up fa-lg"></i> 身長</p>
            <input class="col-md-6" type="text" name="height" placeholder="身長cm" value="<?= isset($app->getValues()->height) ? h($app->getValues()->height) : '' ?>"> 
            <p class="err"><?= h($app->getErrors('height'));?></p>
          </div>
          <div class="weight row d-flex justify-content-center">
            <p class="col-md-6"><i class="fas fa-dumbbell fa-lg"></i> 体重</p>
            <input class="col-md-6" type="text" name="weight" placeholder="体重kg" value="<?= isset($app->getValues()->weight) ? h($app->getValues()->weight) : '' ?>"> 
            <p class="err"><?= h($app->getErrors('weight'));?></p>
          </div>
          <div class="btn-primary btn col-" onclick="document.getElementById('setup').submit();">設定完了</div>
          <input type="hidden" name="token" value="<?= h($_SESSION['token'])?>">
        </form>
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
