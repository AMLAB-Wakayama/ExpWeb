<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- 実験準備 -->

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
      $session = $_POST['session'];
      require('./param.php');
    ?>
    <header>
      <h1><?php echo $title; ?></h1>
      <div class="header-right">ID：<?php echo $id; ?>　Session No.<?php echo $session; ?></div>
    </header>
      
    <section>
  
      <h2>
        <?php print $id. 'さん、よろしくお願いします！<br />'; ?>
      </h2>

      <?php echo $reentry; ?>

      <form method="POST" action="play_<?php echo $engtitle; ?>.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="session" value="<?php echo $session ?>">
        <button id="session" type=“submit” class="btn"><div class="label">スタート</div></button>
      </form>
    </section>

    <hr />
    <footer>
      <p><?php echo $footer; ?></p>
    </footer>
  </body>
</html>