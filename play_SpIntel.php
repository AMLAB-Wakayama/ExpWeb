<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- 音声聴取（書き取り） -->

<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>Web聴取実験</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" type="text/css" href="./ExpWeb.css">
    <link rel="stylesheet" type="text/css" href="./ExpWeb_SpIntel.css">
  </head>
  <body>
    <?php
      $id = $_POST['id'];
      $session = $_POST['session'];
      require('./param.php');
    ?>
    
    <header>
      <h1><?php echo $title; ?></h1>
      <div class="header-right"><?php
        if($session == 99){
          print 'ID：'. $id. '　'. 'Session Practice';
        }else{
          print 'ID：'. $id. '　'. 'Session No. '. $session. ' / '. $session_num;
        }
      ?></div>
    </header>

    <section>
      <h2>
        <div class="font-20px-red">
        <?php 
          if($session == 99){
            print '練習';
          }else{
            print '<div class="font-20px-red">セッション'. $session. '<span class="font-14px-red"> / 全'. $session_num. 'セッション</span></div>';
          }
        ?></div>
        <div class="ttl">単語の書き取り</div>
      </h2>

        <p>様々な単語<?php echo $question_num; ?>個が順番に流れます。単語ごとにすぐ回答用紙に書き込んでください。</p>
        <p>全ての音がはっきりと聞こえなかった場合でも，推測して必ず回答欄を埋めてください。</p>
        <p>前ページで設定した<span>音量を変更しない</span>ようお願いします。</p>
        <p>準備が完了したらスタートを押してください。</p>

        <!-- 再生スタート -->
        <button id="play" class="btn" onclick="getCsvData('<?php echo $list; ?>');disabled = true">音声スタート</button>

        <ol class="stepBar">

          <?php for($i=1; $i<=$question_num; $i++): ?>
            <li id="<?php echo $i-1;?>"><span><?php echo $i;?></span></li>
          <?php endfor; ?>
        </ol>

      <form action="./answer_<?php echo $engtitle; ?>.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="session" value="<?php echo $session; ?>">
        <button type=“submit” class="btn" id="next"><div class="label">回答入力へ</div></button>
      </form>
    </section>


    <script langage="javascript" type="text/javascript">

      // 「次へ」ボタンを非表示
      document.getElementById("next").style.visibility ="hidden";

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

        let element = document.getElementById("0");
        element.classList.toggle('visited');
      
        audio.src = playList[0];
        audio.play();

        audio.addEventListener('ended', function(){
          index++;
          if (index < <?php echo $question_num;?>) {
            // console.log("No. " + index); // for debug
            audio.preload = "auto";
            audio.src = playList[index];
            audio.load();

            // 4秒ごとに再生
            setTimeout(function() {
              let element = document.getElementById(index);
              element.classList.toggle('visited');
              audio.play();
            },4000);
          }else{
          // 全て再生が終われば「次へ」ボタンを表示
          document.getElementById("next").style.visibility ="visible";
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
