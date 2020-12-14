<?php

require_once(__DIR__ . '/PostWeight.php');
require_once(__DIR__ . '/config.php');

$app = new PostWeight();
$app->run();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>体重 - YourFitness</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="wrap">
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

<div class="contents">
  <main class="container psot-weight">
    <h3 class="heading text-center"><?= h(date('Y年m月d日')) ?>（今日）の体重</h3>
    <form action="" method="post" id="weight">
      <div class="post-weight-form text-center row d-flex justify-content-center">
        <div class="today-height row">
          <p class="col-md-6 post-heading">現在の体重（kg）</p>
          <input class="col-md-6"type="text" name="nowWeight"  value="<?= h($_SESSION['me']['nowWeight']) ?>">
          <p class="err"><?= h($app->getErrors('nowWeight'));?></p>
        </div>
      </div>
      <div class="justify-content-center col-sm-12 col-md-6 mx-auto text-center">
            <div class="btn btn-primary" onclick="document.getElementById('weight').submit();">記録</div>
            <input type="hidden" name="token" value="<?= h($_SESSION['token'])?>">
          </form>
          <a class="btn btn-primary"href="index.php">戻る</a>
        </div>

  </main>
  </div>
  <footer class="footer text-center  flex-column d-flex align-items-center justify-content-center">
    <div class="copyrights">
      <p>Copyright©️ YourFitness All Rights Reserved.</p>
      <p>Designed By Taichi Shiozawa</p>
    </div>
  </footer>
  </div>



  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
