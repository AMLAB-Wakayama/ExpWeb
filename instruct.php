<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- 実験説明・同意 -->

<!DOCTYPE html>

<html lang="ja">
  <head>
    <title>Web聴取実験</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" type="text/css" href="./ExpWeb.css">
  </head>
  <body>
    <?php require('./param.php'); ?>
    <header><h1><?php echo $title; ?></h1></header>
      
    <section>
      <h2>実験説明</h2>

      <!-- 実験説明書の表示 -->
      <div class="box-txt">
      <?php
        $filename = './document/'. $instruct. '.txt';
        $fp = fopen($filename, 'r');
        
        while (!feof($fp)) {
          $txt = fgets($fp);
          echo $txt.'<br>';
        }
        fclose($fp);
      ?>
      </div>

      <!-- 説明書ダウンロード -->
      <a href="./document/<?php echo $instruct; ?>.pdf" download="<?php echo $instruct; ?>.pdf">実験説明資料のダウンロード</a>

      <div class="margin-tb-20px">
        和歌山大学 システム工学部 システム工学科 聴覚メディア研究室 殿
        <div class="margin-tb-20px">
        <div class="box-w60per">
          私は実験説明書によって、実験の目的内容並びに実験参加者の被る利益や不利益の可能性及び権利についての説明を受け、これらの内容を十分に理解して検討した上で、
          自由な意志で本実験に参加すること、および本実験にて収集されたデータを貴学および共同研究先に提供することに同意します。
        </div>
        </div>
        同意できない場合は、当Webから退出をお願いします。
      </div>

      <button type="button" class="lbtn" onclick="location.href='confirm.php'">
        <div class="label">同意して参加する</div>
      </button>

      <button type="button" class="lbtn" onclick="location.href='exit.php'">
        <div class="label">同意しないで退出する</div>
      </button>
    </section>

    <hr />
    <footer>
      <p><?php echo $footer; ?></p>
    </footer>
  </body>
</html>