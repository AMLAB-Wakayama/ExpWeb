<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- 回答入力（書き取り） -->

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
          print 'ID：'. $id. '　'. 'Session No.'. $session;
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
        <div class="ttl">回答の入力</div>
      </h2>
      
      <div class="margin-b-30px">
        <p>回答を書き写してください。</p>
        <p>回答は<span>ひらがな</span>のみ、必ず<span>４文字</span>で答えてください。</p>
        <p>文字の数え方に注意してください。</p>
        <div class="index">「ん」や小さい「っ」も１文字と考えます。</div>
        <div class="index">２文字の仮名で表すもの（拗音）も１文字と考えます。</br></div>
        <div class="font-14px-red">例：「きゃ」・「きゅ」・「きょ」</div>
        <div class="index">「ー」（長音符）は使用しないでください。</br></div>
        <div class="font-14px-red">例：「かー」→「かあ」・「しー」→「しい」</div>
      </div>
      
      <!-- 回答入力フォーム 必須・ひらがなのみ -->
      <form method="POST" action="./check_<?php echo $engtitle; ?>.php">
        <?php for($i=1; $i<=$question_num; $i++): ?>
        <div class="margin-tb-2per">
          <label for="answer<?php echo $i;?>"><?php echo $i;?>.&nbsp;</label>
          <input id="answer<?php echo $i;?>" type="text" name="answer<?php echo $i;?>" value="<?php echo $_POST['answer'.$i]; ?>"　pattern="^[ぁ-ん]+$" required>
        </div>
        <?php endfor; ?>

        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="session" value="<?php echo $session; ?>">
        <button type=“submit” class="btn"><div class="label">入力完了</div></button>
      </form>
    </section>

    <hr />
    <footer>
      <p><?php echo $footer; ?></p>
    </footer>
  </body>
</html>
