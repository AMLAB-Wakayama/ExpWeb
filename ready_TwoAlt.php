<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- 実験準備（二肢強制選択） -->
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
              <p>スタートボタンを押すと実験が開始されます。</p>
              <p>イヤホンから単語が流れます。</p>
              <p class="ss"> 流れる単語は<span>日本語４文字</span>の単語です。</p>
              <p class="ss">その音声が<span>男声・女声のどちらに聞こえるか</span>判断し、選択していただきます。</p>
            </td>
          </tr>

          <tr>
            <th>Step4. 回答方法について</th>
            <td>
              <p>「実験スタート」ボタンを押して、実験を開始します。</p>
              <p>スマートフォンからの実験の実施は原則禁止しています。</p>
              <p class="ss"><span>パソコンからの実施</span>をお願いします。</p>
              <p></p>
              <p class="ss"><span>一度回答するとその回答は変更できません</span>ので、慎重に解答をお願いします。</p>
            </td>
          </tr>

          <tr>
            <th>Step5. 実験練習</th>
            <td>
              <p>次に本番の実験と同じ形で練習を行います。</p>
              <p>練習が終わると本番セッションに進むことができます。</p>
            </td>
          </tr>
        </table>

        <p>では、練習を行います。</p>

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
            if (index < playList.length) {
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
