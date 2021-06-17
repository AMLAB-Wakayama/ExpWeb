<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- ブラウザの変更 -->

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
    <?php require('./param.php'); ?>
    <header><h1><?php echo $title; ?></h1></header>
      
    <section>
      <h2>ブラウザを変更してください</h2>

      <p>Google Chromeの使用をお願いします。</p>
      <p>Google Chromeは<a href="https://www.google.com/intl/ja_jp/chrome/">こちら</a>からダウンロードできます。</p>

      <button type="button" class="btn" onclick="location.href='index.php'"><div class="label">TOP画面へ戻る</div></button>
    </section>

    <hr />
    <footer>
      <p><?php echo $footer; ?></p>
    </footer>
  </body>
</html>