<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- 実験準備（書き取り） -->

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
      <h2>実験の準備 2</h2>
      <table>
        <tr>
          <th>Step3. 回答用紙の用意</th>
          <td>
            <!-- 回答用紙ダウンロード -->
            <p>回答用紙をダウンロードし、印刷してください。（A4サイズ4ページ）</p>
            <button class="btn" onclick="window.open('./document/AnswerSheet.pdf')">ダウンロード</button>
            <p>IDを回答用紙(４ページ全て)に記入してください。</p>
          </td>
        </tr>

        <tr>
          <th>Step4. 実験方法について</th>
          <td>
            <p>スタートボタンを押して、実験を開始します。</p>
            <p>ヘッドホン、またはイヤホンから日本語の単語が流れます。</p>
            <p>用意していただいた回答用紙の回答欄に<span>ひらがな</span>で書き込んでください。</p>
            <p class="ss">全ての音がはっきり聞こえなかった場合も、<span>推測して必ず回答欄を埋めてください</span>。</p>
            
            <p>問題数は１回の実験で１０問です。</p>
            <p>問題毎に回答を書き込む時間（４秒程度）を設けています。</p>
            <p>実験１セッションあたりの音声再生時間は１分程度です。</p>
            <p>その後、書き取った単語を文字入力してもらいます。</p>
            <p>全てのセッション終了後、回答用紙をPDFに変換して、提出してもらいます。</p>
          </td>
        </tr>

        <tr>
          <th>Step5. 文字の書き取りについて</th>
          <td>
            
            <p>流れる単語は<span>日本語４文字</span>の単語です。<span>回答も必ず４文字で</span>答えてください。</p>
            <p>文字の数え方に注意してください。</p>
            <div class="index">「ん」や小さい「っ」も１文字と考えます。</div>
            <div class="index">２文字の仮名で表すもの（拗音）も１文字と考えます。</br></div>
            <div class="font-14px-red">例：「きゃ」・「きゅ」・「きょ」</div>
            <div class="index">「ー」（長音符）は使用しないでください。</br></div>
            <div class="font-14px-red">例：「かー」→「かあ」・「しー」→「しい」</div>
          </td>
        </tr>

        <tr>
          <th>Step6. 実験練習</th>
          <td>
            <p>次に本番の実験と同じ形で練習を行います。</p>
            <p>練習が終わると本番セッションに進むことができます。</p>
          </td>
        </tr>
      </table>
      <form method="POST" action="./play_<?php echo $engtitle; ?>.php">
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
