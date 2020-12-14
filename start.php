<?php
 

require_once(__DIR__ . '/Start.php');
require_once(__DIR__ . '/config.php');

$app = new Start();
$app->run();
// var_dump($app->getValues()->declaration);
$bmi = $app->generateBMI($_SESSION['me']['height'], $_SESSION['me']['nowWeight']);
// echo $bmi;
// var_dump($_SESSION['me']);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>目標設定 - YourFitness</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="start">
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
  <main class="container">
    <div class="start-title text-center">
      <h2 class="heading">目標設定</h2>
        <!-- <p>Setting Goal </p> -->
        <p>最後にこれからの目標を立ててフィットネスライフを始めよう。</p>
    </div>

    <div class="current">
      <div class="current-title text-center">
        <h3 class="section-title">現在の<?= h($_SESSION['me']['name'])?>さん</h3>
      </div>
      <div class="metabolism">
        <h3><i class="fas fa-fire fa-lg"></i> 基礎代謝：<?= h($app->generateMetabolism())?>kcal</h3>
        <p>生命の維持だけに必要なエネルギー量です。プラスで自身の活動レベル（運動など）に合わせて摂取しましょう。</p>
      </div>
      <div class="bmi">
        <h3><i class="fas fa-heartbeat"></i> BMI：<?= h($bmi)?></h3>
        <p><?= h($app->diagnosisBMI($bmi))?></p>
        <p class="bmi-description">BMIとは？</p>
        <p>身長と体重から算出される肥満度を示す数値です。数値が高いほど肥満の傾向があり低いほど痩せ型であることを意味します。最も病気のリスクが低く健康的なBMIは「２２」とされています。</p>
      </div>
    </div>
    <div class="set-goal">
      <div class="set-goal-title text-center">
        <h3 class="section-title">これからの目標</h3>
      </div>
      <form action="" method="post" id="setGoal">
        <div class="goal-weight row mx-auto">
          <p class=""><i class="fas fa-dumbbell fa-lg"></i> 目標体重</p>
          <input class="" type="text" name="goalWeight" placeholder="目標体重kg" value="<?= isset($app->getValues()->goalWeight) ? h($app->getValues()->goalWeight) : '' ?>">
          <p class="err"><?= h($app->getErrors('goalWeight'));?></p>
        </div>
        <div class="declaration text-center">
          <p class="text-left"><i class="fas fa-flag-checkered fa-lg"></i> 未来の自分へ一言</p>
          <textarea class="" name="declaration" placeholder="これから頑張る自分に向けて宣言したい言葉を残そう！（任意）"><?= isset($app->getValues()->declaration) ? h($app->getValues()->declaration) : '' ?></textarea>
          <p class="err"><?= h($app->getErrors('declaration'));?></p>
        </div>
      </div>
      <input type="hidden" name="token" value="<?= h($_SESSION['token'])?>">
      <div class="start-btn text-center">
        <div class="btn-primary btn start-btn" onclick="document.getElementById('setGoal').submit();">始める</div>
      </form>
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
