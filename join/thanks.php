<?php 
session_start();
include('app/_parts/_header.php');
?>

<header>
  <a class="headerImg-link" href="index.php"><img class="header-logo" src="headerlogo2.png"></a>
  <div class="header-bars res-phone">
    <a href="index.php"><i class="fas fa-user-plus"></i></a>
    <a href="../"><i class="fas fa-sign-in-alt"></i></a>
    <a class="testLogin" href="index.php"><i class="fas fa-sign-in-alt"></i></a> 
    <!-- <i class="fas fa-bars"></i> -->
  </div>
  <div class="header-buttons">
    <a class="testLogin a-right" href="index.php"><i class="fas fa-sign-in-alt"></i>お試しログイン</a>
    <a href="../"><i class="fas fa-sign-in-alt"></i>ログイン</a>
    <a href="index.php"><i class="fas fa-user-plus"></i>登録する</a>
  </div>
</header>

<div class="container">
  <div class="col-md-2"></div>
  <div class="check-wrapper col-md-8">
    <div class="check-title">
      <h4>登録が完了しました。</h4>
    </div>
    <div class="check-form">
      <p>登録ありがとうございます。Likoをお楽しみください！</p>
    </div>
    <div class="thanks-buttons">
      <a class="thanks-login" href="../"><i class="fas fa-sign-in-alt"></i>ログイン画面へ</a>
    </div>
  </div>
  <div class="col-md-2"></div>
</div>

<footer class="thanks-footer">
  <div class="footer-logo"><img src="headerlogo.png"></div>
  <div class="footer-container">
    <p>2020 ©︎skonishi.</p>
  </div>
</footer>

<?php
  include('app/_parts/_footer.php');
?>