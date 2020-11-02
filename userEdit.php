<?php

require_once(__DIR__ . '/UserEdit.php');

$app = new UserEdit();
$app->run();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー情報の変更 - FitNess</title>
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
          <h2 class="heading">ユーザー情報の変更</h2>
            <p class="err"><?= h($app->getErrors('token'));?></p>
            <form action="" method="post" id="editUser">
              <div class="user-name-edit row justify-content-between">
                <p class="col-sm-12 col-md-4"><i class="fas fa-user"></i> ユーザー名</p>
                <input class="col-sm-12 col-md-8" type="text" name="name" placeholder="name" value="<?php echo $_SESSION['me']['name'] ?>">
                <p class="err"><?= h($app->getErrors('name'));?></p>
              </div>
              <div class="user-email-edit row justify-content-between">
                <p class="col-sm-12 col-md-4"><i class="far fa-envelope fa-lg"></i> メールアドレス</p>
                <input class="col-sm-12 col-md-8" type="text" name="email" placeholder="email" value="<?php echo $_SESSION['me']['email'] ?>">
                <p class="err"><?= h($app->getErrors('email'));?></p>
              </div>
              <div class="user-email-edit row justify-content-between">
                <p class="col-sm-12 col-md-4"><i class="fas fa-arrow-up fa-lg"></i> 身長</p>
                <input class="col-sm-12 col-md-8" type="text" name="height" placeholder="email" value="<?php echo $_SESSION['me']['height'] ?>">
                <p class="err"><?= h($app->getErrors('height'));?></p>
              </div>
              <div class="user-email-edit row justify-content-between">
                <p class="col-sm-12 col-md-4"><i class="fab fa-pagelines fa-lg"></i> 年齢</p>
                <input class="col-sm-12 col-md-8" type="text" name="age" placeholder="年齢（数値のみ）" value="<?php echo $_SESSION['me']['age'] ?>">
                <p class="err"><?= h($app->getErrors('age'));?></p>
              </div>
              <div class="user-email-edit row justify-content-between">
                <p class="col-sm-12 col-md-4">スタート体重</p>
                <input class="col-sm-12 col-md-8" type="text" name="weight" placeholder="スタート時体重kg" value="<?php echo $_SESSION['me']['weight'] ?>">
                <p class="err"><?= h($app->getErrors('weight'));?></p>
              </div>
              <div class="user-email-edit row justify-content-between">
                <p class="col-sm-12 col-md-4">現在の体重</p>
                <input class="col-sm-12 col-md-8" type="text" name="nowWeight" placeholder="現在の体重kg" value="<?php echo $_SESSION['me']['nowWeight'] ?>">
                <p class="err"><?= h($app->getErrors('nowWeight'));?></p>
              </div>
              <div class="user-email-edit row justify-content-between">
                <p class="col-sm-12 col-md-4">目標体重</p>
                <input class="col-sm-12 col-md-8" type="text" name="goalWeight" placeholder="目標体重kg" value="<?php echo $_SESSION['me']['goalWeight'] ?>">
                <p class="err"><?= h($app->getErrors('goalWeight'));?></p>
              </div>
              <div class="user-email-edit row justify-content-between">
                <p class="col-sm-12 col-md-4"><i class="fas fa-flag-checkered fa-lg"></i> 意気込み</p>
                <textarea class="col-sm-12 col-md-8" name="declaration" id=""><?php echo  isset($app->getValues()->declaration) ? $app->getValues()->declaration : $_SESSION['me']['declaration'] ?></textarea>
                <p class="err"><?= h($app->getErrors('declaration'));?></p>
              </div>
              <div class="justify-content-between col-sm-12 col-md-6 mx-auto">
                <div class="btn btn-primary" onclick="document.getElementById('editUser').submit();">更新</div>
                <input type="hidden" name="token" value="<?= h($_SESSION['token'])?>">
            </form>
              <a  class="btn btn-primary"href="userShow.php">戻る</a>
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