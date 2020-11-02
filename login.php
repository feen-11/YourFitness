<?php

require_once(__DIR__ . '/Login.php');

$app = new Login();
$app->run();

// $db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
// var_dump($db);
// var_dump($db['dbname'] = ltrim($db['path'], '/'));
// var_dump($dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8");
// var_dump($user = $db['user']);
// var_dump($password = $db['pass']);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン - YourFitness</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
  <body>

    <div class="login">

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
      <main class="container">
        <div class="login-description mx-auto text-center">
          <h2 class="heading">ログイン</h2>
          <p class="caption">アカウント登録時に設定したメールアドレスとパスワードを入力してください。</p>
        </div>
        <section class="login-form container text-center">
          <form action="" method="post" id="login" >
            <div class="row email">
              <p class="my-auto col-sm-12 col-md-4"><i class="far fa-envelope fa-lg"></i> メールアドレス</p>
              <input class="col-sm-12 col-md-8" type="text" name="email" placeholder="your@example.com" value="<?= isset($app->getValues()->email) ? $app->getValues()->email : '' ?>">
              <p class="err"><?= h($app->getErrors('email'));?></p>
            </div>
            <div class="row password">
              <p class="my-auto col-sm-12 col-md-4"><i class="fas fa-lock fa-lg"></i> パスワード</p>
              <input class="col-sm-12 col-md-8" type="password" name="password" placeholder="password">
              <p class="err"><?= h($app->getErrors('password'));?></p>
              <p class="err"><?= h($app->getErrors('unmatch'));?></p>
            </div>
            <p class="err"><?= h($app->getErrors('token'));?></p>
            <div class="btn-primary btn login-btn" onclick="document.getElementById('login').submit();">ログイン</div>
            <input type="hidden" name="token" value="<?= h($_SESSION['token'])?>">
          </form>
          <div class="justify-content-center col-sm-12 col-md-6 mx-auto text-center">
          <a href="signup.php" class="signup-link btn btn-outline-info">初めての方はこちら</a>
          <a href="aboutYourFitness.php" class="btn btn-outline-info">YourFitnessとは</a>
          </div>
        </section>
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
