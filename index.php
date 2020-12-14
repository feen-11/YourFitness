<?php

require_once(__DIR__ . '/Index.php');
require_once(__DIR__ . '/config.php');

$app = new Index();
$app->run();

// var_dump($_SESSION['me']);

$posts = $app->readPosts();
$foods = $app->readFoods();
$trainings = $app->readTrainings();
$loginDateInfo = $app->readLoginTimes();
$intakeCalorie = $app->totalIntakeCalorie();
$burnCalorie = $app->totalBurnCalorie();
// var_dump($posts);
// var_dump($foods);
// var_dump($trainings);
// var_dump($intakeCalorie);
// echo '<br>';
// var_dump($created = $app->readLoginTimes());
// var_dump($loginDateInfo);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>トップ - YourFitness</title>
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
    <div class="container">
      <div class="create col-md-6 mx-auto text-center">
        <h2 class="heading">記録する</h2>
          <div class="row d-flex justify-content-around">
            <p><a href="postFood.php" class="btn btn-outline-warning">食事</a></p>
            <p><a href="postTraining.php" class="btn btn-outline-primary">運動</a></p>
            <p><a href="postBody.php" class="btn btn-outline-info">日記</a></p>
            <p><a href="postWeight.php" class="btn btn-outline-danger">体重</a></p>
          </div>
      </div>
      <div class="show-posts">
          <?php for($i = 0; $i < count($loginDateInfo) ; $i++) :?>
        <div class= "day">
        <div class="text-center">
          <h3><?= h(date('Y年m月d日',  strtotime($loginDateInfo[$i]['loginDay']))); ?></h3>
          </div>  
          <div class="post">
            <div class="intake post-block">
              <h4><i class="fas fa-utensils"></i>食事</h4>
              <div class="food row d-flex justify-content-around">
                <div class="breakfast col-xs-12 col-md-3">
                  <p class="timeflame">朝食</p>
                      <?php foreach($foods as $food) :?>
                        <?php if($food['created'] === $loginDateInfo[$i]['loginDay'] && $food['timeflame'] === '朝食' && $food['foodName'] ==! ''):?>
                          <p class="post-info"><?= h($food['foodName'])?>：<?= h($food['calorie'])?>kcal</p>
                          <?php endif ;?>
                          <?php endforeach ;?>
                </div>
                <div class="lunch col-xs-12 col-md-3">
                      <p class="timeflame">昼食</p>  
                      <?php foreach($foods as $food) :?>
                        <?php if($food['created'] === $loginDateInfo[$i]['loginDay'] && $food['timeflame'] === '昼食' && $food['foodName'] ==! '') :?>
                          <p class="post-info"><?= h($food['foodName'])?>：<?= h($food['calorie'])?>kcal</p>
                          <?php endif ;?>
                          <?php endforeach ;?>
                </div>
                <div class="dinner col-xs-12 col-md-3">
                          <p class="timeflame">夕食</p>
                          <?php foreach($foods as $food) :?>
                            <?php if($food['created'] === $loginDateInfo[$i]['loginDay'] && $food['timeflame'] === '夕食' && $food['foodName'] ==! '') :?>
                              <p class="post-info"><?= h($food['foodName'])?>：<?= h($food['calorie'])?>kcal</p>
                              <?php endif ;?>
                              <?php endforeach ;?>
                </div>
              </div>
              <div class="row total-intake d-flex justify-content-end">
                <p class="total-calorie">合計摂取カロリー：<?php echo isset($intakeCalorie[$i]['totalIntakeCalorie'])? $intakeCalorie[$i]['totalIntakeCalorie'] : '0'?>kcal</p>
              </div>
            </div>
            <h4><i class="fas fa-running training-title"></i>トレーニング</h4>  
            <div class="training post-block">
                <?php foreach($trainings as $training) :?>
                  <?php if($training['created'] === $loginDateInfo[$i]['loginDay'] && $training['trainingName'] ==! '') :?>
                    <p class="post-info"><?= h($training['trainingName'])?>：<?= h($training['burnCalorie'])?>kcal</p>
                  <?php endif ;?>
                <?php endforeach ;?>
                <div class="row total-burn d-flex justify-content-end">
                  <p class="total-calorie">合計消費カロリー：<?= isset($burnCalorie[$i]['totalBurnCalorie']) ?h($burnCalorie[$i]['totalBurnCalorie']) : '0'?>kcal</p>
                </div>
            </div>
            <h4><i class="fas fa-pencil-alt"></i>日記</h4>
            <div class="diary post-block">
                <?php foreach($posts as $post) :?>
                  <?php if($post['created'] === $loginDateInfo[$i]['loginDay']) :?>
                    <p class="post-info"><?= h($post['body'])?></p>
                  <?php endif ;?>
                <?php endforeach ;?>
            </div>
              <div class="today-weight ">
                <h4><i class="fas fa-dumbbell"></i>体重:<?= h($loginDateInfo[$i]['dayWeight'])?>kg</h4>
              </div>
            </div>
          </div>
         <?php endfor ;?>
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
