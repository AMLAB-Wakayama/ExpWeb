<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- 回答用紙アップロード -->

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
    ?>
    <header>
      <h1><?php echo $title; ?></h1>
      <?php if(!empty($id)): ?>
        <div class="header-right">ID：<?php print $id; ?></div>
      <?php endif; ?>
    </header>
      
    <section>
      <h2>回答用紙のアップロード</h2>

      <p>回答用紙（PDFファイル）のアップロードをお願いします。</p>
      <p>手書きした４ページの回答用紙をスキャンし、文字がはっきりと読めるPDFにしてください。</p>
      <p>回答用紙４ページ分全てのPDFファイルを選択して、アップロードボタンを押してください。</p>
      <p>（スマートホンアプリ「Microsoft Office Lens」等を使用すると、回答用紙をスキャンしてPDFに変換できます。）</p>

      <form method="POST" action="upload.php" enctype="multipart/form-data">
        <?php if(!empty($id)): ?>
          <p class="margin-t-3em"><span>あなたのID：<?php echo $id;?></span></p>
          <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php else: ?>
          <div>
            <label class="align">ID（半角7文字）</label>
            <input id="id" type="text" name="id" pattern="[A-Z0-9]{7}" required>
          </div>
        <?php endif; ?>

        <input type="button" class="btn-gray" onclick="btnclick()" value="ファイル選択">
        <input type="file" id="upfile" name="upfile[]" size="30" accept=".pdf" multiple required onchange=checkfile()>

        <!-- 選択されたファイル名表示 -->
        <div class="frame-gray" id="selectfile">PDFファイル４つを選択してください<br>選択されたファイル名がここに表示されます</div>
        <p class="font-14px-red">４つのPDFファイルが正しく選択されていることを確認の上、アップロードボタンを押してください。<br>
        選択されたファイルが５つ以上の場合は最初の４つのみアップロードされます。</p>  
        <button type=“submit” class="lbtn"><div class="label">アップロード</div></button>
        
      </form>
    </section>

    <script langage="javascript" type="text/javascript">

      function btnclick() {
        document.getElementById("upfile").click();
      }

      // 選択されたファイル情報の読み込み・表示
      function checkfile() {
        var fname = document.getElementById("upfile").files;
        var list = "";

        if(fname.length != 0){
          for (var i=0; i<fname.length; i++){
            list += fname[i].name + "<br />";
            console.log("now List : " + list);
          }
          document.getElementById("selectfile").innerHTML = list;
        }
      }
    </script>
    <hr />
    <footer>
      <p><?php echo $footer; ?></p>
    </footer>
  </body>
</html>
