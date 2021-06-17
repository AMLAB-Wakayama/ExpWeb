<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- 実験準備（一対比較）-->

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
      $session = 99;
      require('./param.php');
      require('savesndlevel.php');
    ?>
    <header>
      <h1><?php echo $title; ?></h1>
      <div class="header-right">ID：<?php echo $id; ?></div>
    </header>
      <h2>実験の準備　2</h2>

      <table>
        <tr>
          <th>Step3. 実験方法について</th>
          <td>
            <p>スタートボタンを押して、実験を開始します。</p>
            <p> イヤホンから2つの音声が流れます。問題数は1回の実験で<?php echo $question_num; ?>問です。</p>
            <p> 1回の実験での所要時間は2分程度です。</p>
          </td>
        </tr>
      </table>

        <p> 次に本番の実験と同じ形で練習を行います</p>

      <form method="POST" action="play_<?php echo $engtitle; ?>.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="session" value="<?php echo $session; ?>">
        <button type=“submit” class="btn"><div class="label">練習へ！</div></button>
      </form>

    <script langage="javascript" type="text/javascript">
  
      // play calibSnd
      // CSVファイルの読み込み
      function getCsvData(dataPath) {
        const request = new XMLHttpRequest();
        request.addEventListener('load', (event) => {
            const response = event.target.responseText;
            convertArray(response);
        });
        request.open('GET', dataPath, true);
        request.send();
      }
      
      // CSVファイルのデータを配列に格納
      function convertArray(data) {
        const dataString = data.split('\n');
        play(dataString);
      }

      // 再生
      function play(playList) {
        
        // console.log("Length. " + playList.length); // for debug

        var audio = new Audio();
        var index = 0;

        audio.src = playList[0];
        audio.play();

        audio.addEventListener('ended', function(){
          index++;
          if (index < playList.length -1) {
            audio.preload = "auto";
            audio.src = playList[index];
            audio.load();

            // 1秒ごとに再生
            setTimeout(function() {
              audio.play();
            },1000);

          }else{
            // 全て再生が終わればもう一度「再生」ボタンを有効化
            document.getElementById("play").disabled = false;
          }
        });
      }
    </script>

    <hr />
    <footer>
      <p><?php echo $footer; ?></p>
    </footer>
  </body>
</html>