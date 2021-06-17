<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- 音声聴取（一対比較） -->

<!DOCTYPE html>
<html lang="ja">
  <head>
    <title>Web聴取実験</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" type="text/css" href="./ExpWeb.css">
    <link rel="stylesheet" type="text/css" href="./ExpWeb_PairCmpr.css">
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
        <?php 
          if($session == 99){
            print '<div class="font-20px-red">練習</div>';
          }else{
            print '<div class="font-20px-red">セッション'. $session. '<span class="font-14px-red"> / 全'. $session_num. 'セッション</span></div>';
          }
        ?>
        <div class="ttl">音声の聞き取り</div>
      </h2>

      <p>準備が完了したらスタートを押してください。</p>
      <p>音量調整の時より、かなり小さい音量で再生される場合もあります。</p>
      <p>その場合でも、<span>設定した音量を変更しないで</span>判断して下さい。</p>
      <h3>2つの音声が流れます。どちらの音声が自然なイントネーションに感じたかボタンを押して回答してください。</h3>

      <!-- 実験UI -->
      <button id="play" class="btn" onclick="getCsvData('<?php echo $list; ?>');disabled = true">音声スタート</button> 
      <div><span id = "qnum">1問</span>&nbsp;/&nbsp;<?php print $question_num; ?>問</div>

      <div class="flex">
      <div class="illuminate"><div id="snd1"><span>音声1</span></div></div>
        <button class="btn" id="ans_m2" onclick="getAns(-2)" disabled>とても自然</button>
        <button class="btn" id="ans_m1" onclick="getAns(-1)" disabled>やや自然</button>
        <button class="btn" id="ans_0" onclick="getAns(0)" disabled>同じくらい</button>
        <button class="btn" id="ans_p1" onclick="getAns(1)" disabled>やや自然</button>
        <button class="btn" id="ans_p2" onclick="getAns(2)" disabled>とても自然</button>
      <div class="illuminate"><div  id="snd2"><span>音声2</span></div></div>
      </div>

      <ol class="stepBar">
          <?php for($i=1; $i<=5; $i++): ?>
            <li id="<?php echo $i;?>"><span></span></li>
          <?php endfor; ?>
      </ol>

      <form action="end.php" method="post" name="form">
        <?php for($i=1; $i<=$question_num; $i++): ?>
            <input type="hidden" name="answer<?php echo $i;?>" value>
            <input type="hidden" name="filename<?php echo $i;?>" value>
        <?php endfor; ?>
        
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="session" value="<?php echo $session; ?>">
        <button type=“submit” class="btn" id="next"><div class="label">実験完了！</div></button>
      </form>
    </section>

    <script langage="javascript" type="text/javascript">

      // 「次へ」ボタンを非表示
      document.getElementById("next").style.visibility ="hidden";

      function switchplay(snd){
        let element = document.getElementById(snd);
        element.classList.toggle('visited');
      }

      let indexTrial = 0; // 問題番号
      let indexPlay = 0; // 再生音声番号
      let playList = []; // 再生リスト

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
        for (let i = 0; i < <?php echo $question_num; ?>; i++)  {
	        nRow = 2*i;
          List1 = dataString[i].split(',');
          playList[nRow]   = List1[0];
          playList[nRow+1] = List1[1];
          document.form.elements["filename"+(i+1)].value = dataString[i];
        }
        // console.log("Length. " + playList.length/2); // for debug 音声リストの長さ確認
        play(indexPlay);
      }

      // 再生
      function play(indexPlay) {
        var count = 0; //音声のカウント
        var audio = new Audio();

        //１つ目の音声再生
        audio.src = playList[indexPlay];
        audio.play();
        switchplay("snd1");

        //2つ目の音声再生
        audio.addEventListener('ended', function(){
          if(count == 0){
            var playTime = function(){
            audio.src = playList[indexPlay+1];
            audio.play();
            count++;
            switchplay("snd2");
            }

            // 1秒ごとに再生(ms)
            setTimeout(playTime,1000);

          }else{
            // 回答ボタンを有効化
            document.getElementById("ans_m2").disabled=false;
            document.getElementById("ans_m1").disabled=false;
            document.getElementById("ans_0").disabled=false;
            document.getElementById("ans_p1").disabled=false;
            document.getElementById("ans_p2").disabled=false;

          }
        });
      }

      // 回答後
      function getAns(ans) {

        // 回答ボタンを無効化
        document.getElementById("ans_m2").disabled=true;
        document.getElementById("ans_m1").disabled=true;
        document.getElementById("ans_0").disabled=true;
        document.getElementById("ans_p1").disabled=true;
        document.getElementById("ans_p2").disabled=true;

        switchplay("snd1");
        switchplay("snd2");

        // 番号更新
        indexTrial = indexTrial + 1;
        indexPlay = indexTrial * 2;


        // 次のページへ渡すために回答保存
        document.form.elements["answer"+indexTrial].value = ans;
        
        if (indexTrial < <?php echo $question_num;?>) {
          var playTime = function(){
            //問題番号表示
            document.getElementById("qnum").innerHTML = indexTrial+1+"問"; 
            // 次の問題を再生
            play(indexPlay);
          }
          // 1秒ごとに再生(ms)
          setTimeout(playTime,1000);
        }else{
          // 全て再生が終われば「次へ」ボタンを表示
          document.getElementById("next").style.visibility ="visible";
        }
      }
    </script>
    
    <hr />
    <footer>
      <p><?php echo $footer; ?></p>
    </footer>
  </body>
</html>