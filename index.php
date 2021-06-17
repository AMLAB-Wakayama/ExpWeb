<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- Top -->

<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>Web聴取実験</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" type="text/css" href="./ExpWeb.css">
  </head>
  <body class="body-top">
    <?php require('./param.php'); ?>
    <header class="header-top"><h1 class="h1-top"><?php echo $title; ?></h1></header>

    <section class="intro">
      <div class="margin-tb-20px">
        <?php echo $intro; ?>
      </div>

      <div class="margin-b-30px"><div class="clm-title">準備するもの</div></div>
      <div class="list-box">
        <?php echo $prepare; ?>
      </div>
    </section>

    <!-- ログイン -->
    <section class="box-clm"> 
      <!-- 初めて -->
      <div class="clm">
      <?php if($task_num == 1): ?>
        <div class="clm-title">実験を開始する方はこちら</div>
      <?php elseif($task_num != 1): ?>
        <div class="clm-title"><div class="font-14px-red">前タスク終了者</div>実験を開始する方はこちら</div>
      <?php endif; ?>
        <div class="clm-content">
          <label class="align">実験説明・同意・ID登録・練習</label>
        </div>
        <button type="button" class="btn" onclick="judgeBrowser(0)"><div class="label">スタート</div></button>
      </div>

      <div class="v_line_fix"></div>

      <!-- ２回目以降 -->
      <div class="clm">
        <div class="clm-title">練習終了済/実験中の方はこちら</div>
        <form name="form" method="POST" onsubmit="judgeBrowser(1)">
          <div class="clm-content">
            <label class="align">クラウドソーシングサービス ユーザー名（半角英数字）</label>
            <input type="text" name="id" pattern="^[0-9A-Za-z]+$" required>
          </div>
          <button type=“submit” class="btn"><div class="label">スタート</div></button>
        </form>
      </div>
    </section>

    <script langage="javascript" type="text/javascript">
      // ブラウザ判定（chrome）
      function judgeBrowser(btn){
        var agent = window.navigator.userAgent.toLowerCase();
        var chrome = (agent.indexOf('chrome') !== -1) && (agent.indexOf('edge') === -1)  && (agent.indexOf('opr') === -1);

        if(chrome == true){
          if(btn == 0){
            window.location.href = 'instruct.php';
          }else if(btn == 1){
            document.form.action="count.php";
            document.form.method="POST";
          }
        }else{
          if(btn == 0){
            window.location.href = 'change.php';
          }else{
            document.form.action="change.php";
          }
        }
      }
    </script>

    <hr />
    <footer>
      <p><?php echo $footer; ?></p>
    </footer>
  </body>
</html>