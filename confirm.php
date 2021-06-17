<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- 同意確認 -->

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
      <h2>同意の確認</h2>

      <div class="margin-tb-20px">
        <span>ボタンの押し間違え等を防ぐため、もう一度同意を確認させてください。</span>
        <div class="margin-tb-20px">
        <div class="box-w60per">
          私は実験説明書によって、実験の目的内容並びに被験者の被る利益や不利益の可能性及び権利についての説明を受け、
          これらの内容を十分に理解して検討した上で、自由な意志で本実験に参加することに同意します。
        </div>
        </div>
        同意できない場合は、当Webから退出お願いします。
      </div>

      <button type="button" class="lbtn" onclick="location.href='entry.php'">
        <div class="label">同意して参加する</div>
      </button>

      <button type="button" class="lbtn" onclick="location.href='instruct.php'">
        <div class="label">もう一度説明を確認する</div>
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