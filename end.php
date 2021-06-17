<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- クラウドソーシングサービス入力内容表示 -->

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
      $swrslt = 1;

      if(empty($_POST['filename1'])){
        $swrslt = 0;
      }
      
      // 回答の保存
      //CSVファイルに書き込むデータの準備
      $data .= "ID". ",". $id. "\n". "No.". ",". $session. "\n". "List". ",". $list; 
      $data .= "\n";
      for($i=1; $i<=$question_num; $i++){
        $data .= $i. ",";
        if($swrslt == 1){
          $filename = $_POST['filename'.$i];
          $filename = str_replace("\r\n", '', $filename);
          $data .= $filename. ",";
        }
        $data .= $_POST['answer'.$i]. "\n";
      }

      // ファイル名準備
      $fname = './result/'. $id. '/'. $id. '_'. $session. '.csv';

      // ファイル作成・書き込み
      $file = fopen($fname, 'w');
      fwrite($file, $data);
      fclose($file);

      // 作成したファイルの権限を制御 rw-rw-rw
      chmod($fname, 0777);
    ?>
    <header>
      <h1><?php echo $title; ?></h1>
      <div class="header-right">
      <?php
        if($session == 99){
          print 'ID：'. $id. '　'. 'Session Practice';
        }else{
          print 'ID：'. $id. '　'. 'Session No.'. $session;
        }
      ?>
      </div>
    </header>

    <section>
      <h2>ありがとうございました</h2>

      <!-- 全ての実験が終了した場合 -->
      <?php if($session == $session_num): ?>
        <?php
          date_default_timezone_set('Asia/Tokyo');
          $now =  (new DateTime())->format('Y-m-d H:i:s');

          $str = $id. $now;
          $hash = password_hash($str, PASSWORD_DEFAULT);

          $fname = './result/'. $id. '/'. $id. '_info.txt';
          $data = "Time_Finish: ". $now. "\n";
          $data .= "Hash_Finish: ". $hash. "\n";
          $file = fopen($fname, 'a');
          fputs($file, $data);
          fclose($file);

          if($swrslt == 1){
            chmod($fname, 0777); // permission rw-rw-rw
          }
        ?>
        <p>これで全ての実験が終了です。ご協力ありがとうございました。</p>
        <p><span>赤枠内の内容をコピーしてクラウドソーシングサービスのフォームに入力してください。</span></p>
        <!-- クラウドソーシングサービス入力内容表示 -->
        <div class="frame-red">
          ID：<?php print $id; ?><br />
          <?php print $hash; ?>
        </div>

        <!-- 回答PDF提出（書取実験） -->
        <?php if($swrslt == 0): ?>
          <p>コピー＆ペーストだけして、まだ<span> クラウドソーシングサービスに送信しない</span>でください。</span></p>
          <p><span>次に、回答用紙をPDFに変換して提出していただきます。</span></p>
          <form method="POST" action="form.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button class="lbtn"><div class="label">回答用紙を登録</div></button>
          </form>
        <?php endif; ?>

      <!-- 実験が続く場合 -->
      <?php else: ?>
        <?php
          // 次のセッション番号確認
          $nextsession = 0;
          foreach(glob("./result/". $id. "/". $id. "*.csv") as $file) {
            $nextsession++;
          }
        ?>

        <?php if($session == 99): ?>
          <p>以上で練習は終了です！</p>
        <?php else: ?>
          <p>以上でセッション<?php print $session; ?>は終了です！</p>
        <?php endif; ?>

        <p class="font-20px-red">次は実験セッション<?php echo $nextsession; ?>です。</p>
        <p>長時間におよぶ実験の場合、集中力を維持するため15分に1度程度休憩をとるようお願いします。</p>
        <section class="box-clm">
          <!-- 休憩 -->
          <div class="clm">
            <div class="margin-b-30px"><div class="clm-title">休憩を取る</div></div>
            <p>TOP画面に戻ってID入力で再開できます</p>
            <button class="lbtn" onclick="location.href='index.php'"><div class="label">TOP画面へ戻る</div></button>
          </div>

          <div class="v_line_fix"></div>

          <!-- 続けて次のセッションへ -->
          <div class="clm">
            <div class="margin-b-30px"><div class="clm-title">続けて実験する</div></div>
            <p>次の実験セッションへ遷移します</p>
            <form method="POST" action="play_<?php echo $engtitle; ?>.php">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="hidden" name="session" value="<?php echo $nextsession ?>">
              <button id="session" type=“submit” class="lbtn"><div class="label">続ける</div></button>
            </form>
          </div>
        </section>
      <?php endif; ?>

    </section>

    <hr />
    <footer>
      <p><?php echo $footer; ?></p>
    </footer>
  </body>
</html>
