<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- アップロード結果・クラウドソーシングサービス入力内容表示 -->

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
      $error = 0;
    ?>
    <header>
      <h1><?php echo $title; ?></h1>
      <div class="header-right">ID：<?php print $id; ?></div>
    </header>
      <?php
        // セッション番号確認(回答CSV数を確認)
        $session = 0;
        foreach(glob("./result/". $id. "/". $id. "*.csv") as $file) {
          $session++;
        }
      ?>
      
    <!-- 実験すべて終了している場合 -->
    <?php if($session > $session_num): ?>

      <!-- ファイルのアップロード -->
      <?php
        $fnum = count($_FILES["upfile"]["name"]);

        if($fnum >= 4){
          $fnum = 4;
        }

        for($i = 0; $i < $fnum; $i++){
          if (is_uploaded_file($_FILES["upfile"]["tmp_name"][$i])){
            $fname = $id. "_answer". ($i+1). ".pdf"; // resultに保存するときの名前
            if (move_uploaded_file($_FILES["upfile"]["tmp_name"][$i], './result/'. $id. '/'. $fname)){
            }else{
              $error = 1;
            }
          }else{
            $error = 1; // セキュリティ対策
          }
        }
      ?>

      <!-- アップロード成功 -->
      <?php if($error == 0): ?>
        <?php
          // info.txtにアップロード時刻とHash値を追加
          date_default_timezone_set('Asia/Tokyo');
          $now =  (new DateTime())->format('Y-m-d H:i:s');

          $str = $id. $now;
          $hash = password_hash($str, PASSWORD_DEFAULT);

          $fname = './result/'. $id. '/'. $id. '_info.txt';
          $data = "\n";
          $data .= "Time_Upload: ". $now. "\n";
          $data .= "Hash_Upload: ". $hash. "\n";
          $file = fopen($fname, 'a');
          fputs($file, $data);
          fclose($file);
          // chmod($fname, 0444); // permission r--r--r--
        ?>
        
        <section>
          <h2>ありがとうございました</h2>
          <p>選択されたファイルは、名前が変更されてアップロードされました。</p>
          <p> 各ファイル名をクリックして、回答用紙4ページ分であることを確認してください。(別のタブで開かれます。)</p>
          
          <div class="frame-gray">
            <?php foreach(glob("./result/". $id. "/". "*.pdf") as $file): ?>
              <?php $fname = strrchr($file, "/"); ?>
              <a href="<?php echo $file; ?>" target="info"><?php print substr($fname, 1); ?></a><br>
            <?php endforeach?>
          </div>

          <div id="checkfile">
            <p>もし、間違っていた場合、以下からアップロードページに戻り正しいファイルを提出し直してください。</p>
            <p>先ほどアップロードされたファイルは上書きされます。(確実に置き換えるため、必ず4つずつ選択してください。）</p>
            <form method="POST" action="form.php">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <button class="lbtn" type=“submit”><div class="label">アップロード画面へ戻る</div></button>
            </form> 
            <button class="lbtn" onclick="disphash()"><div class="label">確認したので終了する</div></button>
          </div>

          <div id="disphash" style="display:none;">
            <p><span>赤枠内の内容をコピーしてクラウドソーシングサービスのフォームに追加入力し、送信してください。</span></p>
            <div class="frame-red">
              Uploaded：<?php print $id; ?><br>
              <?php print $hash; ?>
            </div>
            <p><span> 以上で全てのタスクが終了です。ありがとうございました。</span></p>
          </div>
        </section>

      <!-- アップロード失敗 -->
      <?php elseif($error == 1): ?>
        <section>
          <h2>アップロード失敗</h2>
          <p>ファイルのアップロードに失敗しました。</p>
          <p>ファイルサイズが大きい可能性があります。</p>
          <p>アップロード画面に戻り、もう一度アップロードし直してください。</p>
          <form method="POST" action="form.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button class="lbtn" type=“submit”><div class="label">アップロード画面へ戻る</div></button>
          </form>
        </section>
      <?php endif; ?>

    <!-- IDを間違えているとき/実験途中 -->
    <?php else: ?>
      <section>
        <h2>IDが登録されていません</h2>
        <p>IDを正しく入力してください。</p>
        <p>次のボタンを押すと、アップロード画面に戻ります。</p>
        <button class="lbtn" onclick="location.href='form.php'"><div class="label">アップロード画面へ戻る</div></button>
      </section>
    <?php endif;?>

    <script langage="javascript" type="text/javascript">
      function disphash(){
        document.getElementById('checkfile').style.display = "none";
        document.getElementById('disphash').style.display = "inline";
      }
    </script>
    <hr />
    <footer>
      <p><?php echo $footer; ?></p>
    </footer>
  </body>
</html>
