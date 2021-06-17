<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- セッション番号確認 -->

<!DOCTYPE html>
<html lang="ja">
  <head>
  <head>
    <title>Web聴取実験</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" type="text/css" href="./ExpWeb.css">
  </head>
  <body>
    <?php
      $id = $_POST['id'];
      require('./param.php');
    ?>

    <header><h1><?php echo $title; ?></h1></header>

    <?php
      // セッション番号確認
      $session = 0;
      foreach(glob("./result/". $id. "/". $id. "*.csv") as $file) {
        $session++;
      }
      $presession = $session - 1;
    ?>

    <!-- 練習セッションの回答が保存されていない場合 -->
    <?php if($session == 0): ?>
      <h2>IDが登録されていません</h2>
      <p>IDを正しく入力してください。</p>
      <p>練習を行っていない場合、TOP画面左側「実験を開始する方はこちら」から開始してください。</p>
      <button class="lbtn" onclick="location.href='index.php'"><div class="label">TOP画面へ戻る</div></button>

    <!-- 全ての回答が揃っている場合（全ての実験が終了している場合） -->
    <?php elseif($session > $session_num): ?>
      <h2>ありがとうございました</h2>
      <p>実験は全て終了しました。</p>
      <p>ご協力ありがとうございました。</p>
      <button class="lbtn" onclick="location.href='index.php'"><div class="label">TOP画面へ戻る</div></button>

    <!-- 実験が続く場合 -->
    <?php else: ?>
      <h2>セッション番号の確認</h2>
      <!-- 練習終了済 -->
      <?php if($session == 1): ?>
        <div class="font-25px">ID：<?php echo $id;?><br />
        これから行うセッション番号：<?php echo $session;?></div>
        <div class="font-20px-red">練習終了済</div>
      <!-- 本番実験中 -->
      <?php else: ?>
        <div class="font-25px">ID：<?php echo $id;?><br />
        これから行うセッション番号：<?php echo $session;?></div>
        <div class="font-20px-red">セッション<?php echo $presession;?>まで終了済（全<?php echo $session_num;?>セッション）</div>
      <?php endif; ?>

      <p>セッション番号に間違いがあれば、TOP画面に戻りIDをもう一度確認して入力してください。</p>
      <form method="POST" action="reentry.php">
        <button id="session" type=“submit” class="lbtn"><div class="label">実験スタート</div></button>
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="hidden" name="session" value="<?php echo $session;?>">
      </form>
      <button class="lbtn" onclick="location.href='index.php'"><div class="label">TOP画面へ戻る</div></button>
    <?php endif; ?>

    <hr />
    <footer>
      <p><?php echo $footer; ?></p>
    </footer>
  </body>
</html>

    

