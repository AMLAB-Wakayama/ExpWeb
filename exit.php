<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- 退出 -->

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
  
      <h2>ありがとうございました</h2>

      <div>
        和歌山大学 聴覚メディア研究室のホームページへ遷移します。
      </div>

      <form method="POST" action="https://media.sys.wakayama-u.ac.jp/AuditoryMediaLab/">
        <button class="lbtn"><div class="label">聴覚メディア研究室へ</div></button>
      </form>
    </section>

    <hr />
    <footer>
      <p><?php echo $footer; ?></p>
    </footer>
  </body>
</html>