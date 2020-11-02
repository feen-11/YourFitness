<?php

require_once(__DIR__ . '/Signup.php');

$app = new Signup();
$app->run();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規登録 - YourFitness</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="signup">
    <div class="header-wrapper flex-column d-flex align-items-center justify-content-center">
      <article class="title-header container text-center">
          <div class="title mx-auto col-lg-8">
            <h1 class="">YourFitness</h1>
          </div>
          <div class="description center-block mx-auto">
            <p>フィットネスに勤しむ方へ。毎日のトレーニングや食事を管理。さらなる高みへ。</p>
          </div>
      </article>
    </div>

    <main>
      <div class="signup-main container text-center">
        <h2 class="heading">新規登録</h2>
        <div class="caption">
            <p class="caption">初めての方はユーザー登録が必要です。任意のニックネーム、メールアドレス、パスワードの三つを入力してください。</p>
            <p class="">※このアプリケーションは練習用に作成しました。重要な個人情報は入力しないでください。</p>
          </div>
        <div class="signup-form">
          <p class="err"><?= h($app->getErrors('token'));?></p>
            <form class="" action="" method="post" id="signup">
              <div class="row name">
                <p class="col-sm-12 col-md-4"><i class="fas fa-user fa-lg"></i> ユーザー名</p>
                <input class="col-xs-10 col-md-8" type="text" name="name" placeholder="ユーザー名" value="<?= isset($app->getValues()->name) ? $app->getValues()->name : '' ?>">
                <p class="err col-12"><?= h($app->getErrors('name'));?></p>
              </div>
              <div class="row email">
                <p class="col-sm-12 col-md-4"><i class="far fa-envelope fa-lg"></i> メールアドレス</p>
                <input class="col-xs-10 col-md-8" type="text" name="email" placeholder="your@example.com" value="<?= isset($app->getValues()->email) ? $app->getValues()->email : '' ?>">
                <p class="err col-12"><?= h($app->getErrors('email'));?></p>
              </div>
              <div class="row password">
                <p class="col-xs-12 col-md-4"><i class="fas fa-lock fa-lg"></i> パスワード</p>
                <input class="col-xs-12 col-md-8" type="password" name="password" placeholder="password">
                <p class="err col-12"><?= h($app->getErrors('password'));?></p>
              </div>
              <div class="btn-primary btn " onclick="document.getElementById('signup').submit();">登録</div>
              <input type="hidden" name="token" value="<?= h($_SESSION['token'])?>">
            </form>
            <div class="justify-content-center col-sm-12 col-md-6 mx-auto text-center">
              <a href="login.php" class="btn btn-outline-info">登録済みの方はこちら</a>
              <a href="aboutYourFitness.php" class="btn btn-outline-info">YourFitnessとは</a>
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

  </div>

  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>