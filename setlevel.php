<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- 実験準備(音量設定) -->

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
      require('./param.php');
      require('./checkid.php');
    ?>
    <header>
      <h1><?php echo $title; ?></h1>
      <div class="header-right">ID：<?php echo $id; ?></div>
    </header>

    <?php if($error == 1): ?>
      <h2>参加できません</h2>
      <p>以前、音声了解度実験に参加頂いた方は今回の参加はご遠慮ください。</p>
      <p>下のボタンを押すと和歌山大学 聴覚メディア研究室のホームページへ遷移します。</p>
      <button class="lbtn" onclick="location.href='https://media.sys.wakayama-u.ac.jp/AuditoryMediaLab/'"><div class="label">聴覚メディア研究室へ</div></button>
    
    <?php elseif($error == 2): ?>
      <h2>参加できません</h2>
      <p>以前、音声了解度実験に参加頂いていない方は今回の参加はご遠慮ください。</p>
      <p>下のボタンを押すと和歌山大学 聴覚メディア研究室のホームページへ遷移します。</p>
      <button class="lbtn" onclick="location.href='https://media.sys.wakayama-u.ac.jp/AuditoryMediaLab/'"><div class="label">聴覚メディア研究室へ</div></button>
    
    <?php elseif($error == 3): ?>
      <h2>実験を再開できません</h2>
      <p>TOP画面の右側「練習終了済/実験中の方はこちら」から実験を再開してください。</p>
      <button class="lbtn" onclick="location.href='index.php'"><div class="label">TOP画面へ戻る</div></button>

    <?php else: ?>
      <?php require('./saveid.php'); ?>
      <h2>実験の準備 1</h2>
      <form name="sbjinfo" method="POST" action="./ready_<?php echo $engtitle; ?>.php">
      <table>
        <tr>
          <th>Step1. IDをメモ</th>
          <td>
            <p class="ttl">あなたのIDは、<span><?php echo $id; ?></span>です。</p>
            <p>実験は<?php echo $question_num; ?>問×<?php echo $session_num; ?>セッションあります。</p>
            <p>セッションを再開するとき、このIDが必要になります。</p>
          </td>
        </tr>

        <tr>
          <th>Step2. 音量の設定</th>
          <td>
          <?php if($task_num == 1): ?>
            <p>ボタンを押すと単語が５つ流れます。</p>
            <p>聞こえやすいと思う音量に設定してください。何度でも再生できます。</p>
            <button class="btn" onclick="getCsvData('<?php echo $list_calib; ?>');disabled = true" id="play"><div class="label">再生</div></button>
            <p>設定した音量の数値を以下に入力してください。※音量設定と数値の確認方法について <a href='./document/VolumeSetting.pdf' target='_blank' rel='noopener'>ヘルプ</a></p>
            <div class="margin-tb-2per">
              <label>設定音量（半角数字）</label>
              <input id="sndlevel" type="text" name="sndlevel" pattern="(0|[1-9][0-9]*)" required>
            </div>
            <p>聞き取りやすい音量に設定したら、<span>実験中は変更しないようにしてください</span>。</p>
          <?php else: ?>
            <p>前回の実験で設定された音量は<span><?php echo $sndlevel; ?></span>です。</p>
            <p>この音量に設定してください。※音量設定と数値の確認方法について <a href='./document/VolumeSetting.pdf' target='_blank' rel='noopener'>ヘルプ</a></p>
            <p>ボタンを押すと単語が５つ流れます。</p>
            <p>聞こえやすい音量であるか確認してください。何度でも再生できます。</p>
            <button class="btn" onclick="getCsvData('<?php echo $list_calib; ?>');disabled = true" id="play"><div class="label">再生</div></button>
            <p>もしどうしても音が大きくて耐えられない場合、聞きやすい音量に変更してもかまいませんが、記録をお願いします。</p>
            <div class="margin-tb-20px">
              <div>
                <label>前回設定した音量から変更</label>
                <input id="levelchange" type="radio" name="levelchange" value="not-change" onclick="checkchange()" required>変更なし
                <input id="levelchange" type="radio" name="levelchange" value="change" onclick="checkchange()">変更あり&nbsp;<input id="sndlevel" type="text" name="sndlevel" disabled>
              </div>
        </div>
          <?php endif; ?>
          </td>
        </tr> 
      </table>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="session" value="<?php echo $session; ?>">
        <button type=“submit” class="btn"><div class="label">次へ！</div></button>
      </form>
    
    <?php endif;?>

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

      function checkchange(){
        if(document.sbjinfo["levelchange"][1].checked ) {
          document.sbjinfo["sndlevel"].disabled = false;
          // document.getElementById('sndlevel').style.display = "inline";
         }else{
          document.sbjinfo["sndlevel"].disabled = true;
        }
      }
    </script>

    <hr />
    <footer>
      <p><?php echo $footer; ?></p>
    </footer>
  </body>
</html>