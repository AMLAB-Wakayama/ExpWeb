<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- 回答確認（書き取り） -->

<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>Web聴取実験</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" type="text/css" href="./ExpWeb.css">
  </head>
  <body>
    <?php
      $id = $_POST['id'];
      $session = $_POST['session'];
      require('./param.php');
    ?>
    <header>
      <h1><?php echo $title; ?></h1>
      <div class="header-right"><?php
        if($session == 99){
          print 'ID：'. $id. '　'. 'Session Practice';
        }else{
          print 'ID：'. $id. '　'. 'Session No.'. $session. ' / '. $session_num;
        }
      ?></div>
    </header>

    <section> 
      <h2>
        <div class="font-20px-red"><?php
          if($session == 99){
            print '練習';
          }else{
            print 'セッション'. $session;
          }
        ?></div>
        <div class="ttl">回答の確認</div>
      </h2>

      <p>回答用紙に手書きした文字と入力された文字が一致しているか確認してください。</p>
      <p>間違いがあった場合は訂正してください。</p>

      <div class="frame-gray">
      <!-- 回答表示 -->
      <?php
        print 'ID: '. $id. '<br />';
        if($session == 99){
          print 'Session Practice'. '<br />';
        }else{
          print 'Session No.'. $session. '<br />';
        }

        for($i=1; $i<=$question_num; $i++){
          print $i .', '. $_POST['answer'.$i] .'<br />';
        }
      ?>
      </div>

      <!-- 最後のページへ -->
      <form action="./end.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="session" value="<?php echo $session; ?>">

        <?php for($i=1; $i<=$question_num; $i++): ?>
          <input type="hidden" name="answer<?php echo $i;?>" value="<?php echo $_POST['answer'.$i]; ?>">
        <?php endfor; ?>

        <button class="lbtn" type=“submit”><div class="label">登録する</div></button>
      </form>

      <!-- 回答訂正ページへ -->
      <form method="POST" action="./answer_<?php echo $engtitle; ?>.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="session" value="<?php echo $session; ?>">
        
        <?php for($i=1; $i<=$question_num; $i++): ?>
          <input type="hidden" name="answer<?php echo $i;?>" value="<?php echo $_POST['answer'.$i]; ?>">
        <?php endfor; ?>

        <button class="lbtn" type=“submit”><div class="label">訂正する</div></button>
      </form>
    </section>

    <hr />
    <footer>
      <p><?php echo $footer; ?></p>
    </footer>
  </body>
</html>