<?php 
session_start();
require('../dbconnect.php');

if(!isset($_SESSION['join'])){
  header('Location:   index.php');
  exit;
}

$defHash = "da39a3ee5e6b4b0d3255bfef95601890afd80709";
//画像が選択された時のみ表示するように設定
//選択していない場合は日付 + defHashの値となる
if($_SESSION['join']['image'] != $_SESSION['join']['time'].$defHash){
  $imageName = $_SESSION['join']['image'];
  list($width, $height, $type, $attr) = getimagesize('../member_picture/'.$imageName);

  $newWidth = 0;//新横幅
  $newHeight = 0;//新縦幅
  $w = 100;//最大横幅
  $h = 100;//最大縦幅

  if($h < $height && $w < $width){
    if($w < $h){
      $newWidth = $w;
      $newHeight = $height * ($w / $width);
    } else if($h < $w) {
      $newWidth = $width * ($h / height);
      $newHeight = $h;
    }else{
      if($width < $height){
        $newWidth = $width * ($h / $height);
        $newHeight = $h;
      }else if($height < $width){
        $newWidth = $w;
        $newHeight = $height * ($w / $width);
      }else if($height == $width){
        $newWidth = $w;
        $newHeight = $h;
      }
    }
  }else if($height < $h && $width < $w){
      $newWidth = $width;
      $newHeight = $height;
  }else if($h < $height && $width <= $w){
      $newWidth = $width * ($h / $height);
      $newHeight = $h;
  }else if($height <= $h && $w < $width){
      $newWidth = $w;
      $newHeight = $height * ($w / $width);
  }else if($height == $h && $width < $w){
      $newWidth = $width * ($h / $height);
      $newHeight = $h;
  }else if($height < $h && $width == $w){
      $newWidth = $w;
      $newHeight = $height * ($w / $width);
  }else{
      $newWidth = $width;
      $newHeight = $height;
  }

  $ext = substr($imageName,-4);
  if($ext == 'jpeg' || $ext == 'JPEG'){
      $ext = '.' . $ext;
  }
}

//画像リサイズ
if($ext == '.gif'){
    $baseImage = imagecreatefromgif('../member_picture/'.htmlspecialchars($imageName,ENT_QUOTES));
    $image = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($image, $baseImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    imagegif($image, '../member_picture/'.htmlspecialchars($imageName,ENT_QUOTES));
}else if($ext == '.png' || $ext == '.PNG'){
    $baseImage = imagecreatefrompng('../member_picture/'.htmlspecialchars($imageName,ENT_QUOTES));
    $image = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($image, $baseImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    imagepng($image, '../member_picture/'.$imageName);
}else if($ext == '.jpg' || $ext == '.jpeg' || $ext == '.JPG' || $ext == '.JPEG'){
    $baseImage = imagecreatefromjpeg('../member_picture/'.htmlspecialchars($imageName,ENT_QUOTES));
    $image = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($image, $baseImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    imagejpeg($image, '../member_picture/'.htmlspecialchars($imageName,ENT_QUOTES));
}

//登録処理
if(!empty($_POST)) {
    $statement = $db->prepare('INSERT INTO members SET name=?,email=?,password=?,picture=?, session_id=?, created=NOW()');
    $ret = $statement->execute(array(
      $_SESSION['join']['name'],
      $_SESSION['join']['email'],
      hash('sha256',$_SESSION['join']['password']),
      $_SESSION['join']['image'],
      hash('sha256',$_SESSION['join']['email']),
    ));
    unset($_SESSION['join']);

    header('Location:   thanks.php');
    exit();
}

include('app/_parts/_header.php');
?>

<header>
  <a class="headerImg-link" href="index.php"><img class="header-logo" src="headerlogo2.png"></a>
  <div class="header-bars res-phone">
    <a class="testLogin checkBar" href="index.php">Topに戻る</a>
  </div>
  <div class="header-buttons">
    <a class="a-right testLogin" href="index.php">Topに戻る</a>
  </div>
</header>

<div class="container">
  <div class="col-md-2"></div>
  <div class="check-wrapper col-md-8">
    <div class="check-title">
      <h4>登録内容の確認</h4>
    </div>
    <div class="check-form">
      <form action="" enctype="multipart/form-data" method="post">
        <input name="action" type="hidden" value="submit">
        <h4>ハンドルネーム</h4>
        <p><?php echo h($_SESSION['join']['name']); ?></p>
        <h4>メールアドレス</h4>
        <p><?php echo h($_SESSION['join']['email']); ?></p>
        <h4>パスワード</h4>
        <p>表示されません(暗号化されて格納されます)。</p>
        <h4>アイコン画像</h4><?php if($_SESSION['join']['image'] != $_SESSION['join']['time'].$defHash) :?><img class="iconImg" src="../member_picture/%3C?php%20echo%20h($_SESSION['join']['image']);%20?%3E">
        <p><br>
        アイコンは画像の中心から切り抜かれます。</p><?php else: ?>
        <p>設定されていません。<br>
        デフォルトのアイコンが自動で設定されます。</p><?php endif; ?>
        <div class="checkForm-buttons">
          <a class="checkRewrite" href="index.php?action=rewrite">書き直す</a> <input class="checkSub" type="submit" value="登録する">
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-2"></div>
</div>

<footer>
  <div class="footer-logo"><img src="headerlogo.png"></div>
  <div class="footer-container">
    <p>2020 ©︎skonishi.</p>
  </div>
</footer>

<?php
  include('app/_parts/_footer.php');
?>