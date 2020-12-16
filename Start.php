<?php

require_once(__DIR__ . '/Controller.php');
require_once(__DIR__ . '/User.php');
require_once(__DIR__ . '/InvalidToken.php');
require_once(__DIR__ . '/InvalidWeight.php');
require_once(__DIR__ . '/InvalidBody.php');

class Start extends Controller {

  public function run() {
    if (!$this->loginCheck()) {
      // login
      header('Location: ' . SITE_URL . '/login.php');
      exit;
    }
    if (!$this->setUpCheck()) {
      // setup
      header('Location: ' . SITE_URL . '/setUp.php');
      exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $this->postProcess();
    }
  }

    public function postProcess(){
        try{
          $this->validate();
        }catch(InvalidToken $e){
          $this->setErrors('token', $e->getMessage());
        }catch(InvalidWeight $e){
          $this->setErrors('goalWeight', $e->getMessage());
        }catch(InvalidBody $e){
          $this->setErrors('declaration', $e->getMessage());
        }
        $this->setValues('goalWeight', $_POST['goalWeight']);
        $this->setValues('declaration', $_POST['declaration']);

        if($this->hasError()){
              return;
            } else{
              $app = new User();
              $app->setGoal();
              header('Location: ' . SITE_URL . '/index.php');
            }
          }

  public function generateBMI($height, $weight){
    $heightM = pow($height, 2) / 10000;
    // 小数点切り上げ
    return $bmi = round($weight / $heightM, 2);
  }

  public function diagnosisBMI($bmi){
    if($bmi < 18.5){
      return 'あなたのBMIは標準よりも小さく、痩せていると判定されました。肥満は健康の大敵ですが、もちろん痩せすぎも良くありません。普段から食欲がなかったり運動不足だったりする方は、きちんと食べて適度に運動するように心がけてください。';
    }
    elseif($bmi >=18.5 && $bmi < 25){
      echo 'あなたのBMIは標準の範囲内と判定されました。今の体重をキープするように心がけてください。ただし、体重は標準でも体脂肪率の高い「隠れ肥満」の可能性もあります。日頃から運動不足が気になる方は、適度に運動して自己管理に努めてください。';
    }
    elseif($bmi <= 25){
      echo 'あなたのBMIは標準よりも高く、肥満気味であると判定されました。肥満はさまざまな生活習慣を引き起こす、健康の大敵です。食生活を見直し、適度な運動を取り入れて自己管理に努めてください。';
    }
  }

  public function validate(){
    if(!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']){
      throw new InvalidToken();
    }

    if($_POST['goalWeight'] === '' || $_POST['goalWeight'] > 500){
      throw new InvalidWeight();
    }

    if(empty($_POST['declaration']) ||mb_strlen($_POST['declaration']) > 191){
      throw new InvalidBody();
    };
  }


  }

  



?>
