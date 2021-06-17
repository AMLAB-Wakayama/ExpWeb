<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- ID用情報入力 -->

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
      <h2>情報の登録</h2>
      <?php if($task_num != 1): ?>
        <div class="margin-b-50px">
          <p>確認のため、もう一度入力をお願いします。<br>
          前回使用した機材と同じものを使用してください。</p>
        </div>
      <?php endif; ?>

      <form name="sbjinfo" method="POST" action="./setlevel.php">
        <div class="margin-b-50px">
          <div class="margin-tb-2per">
            <!-- ユーザー基本情報 -->
            <label>クラウドソーシングサービス ユーザー名（半角英数字）</label>
            <input id="id" type="text" name="id" pattern="^[0-9A-Za-z]+$" required> 
          </div>
          <div class="margin-tb-2per">
            <label>クラウドソーシングサービス ユーザー名（確認）</label>
            <input id="id" type="text" name="id_check" pattern="^[0-9A-Za-z]+$" required oncopy="return false" onpaste="return false" oncontextmenu="return false" oninput="checkname(this)"><br>
            <span class="font-14px-red">ランサーズに登録しているユーザー名を入力してください</span>
          </div>

          <div>
            <label>性別</label>
            <input id="gender" type="radio" name="gender" value="M" required>男性
            <input id="gender" type="radio" name="gender" value="F">女性
          </div>
          <div class="margin-tb-2per">
            <label>年齢（半角数字２桁）</label>
            <input id="age" type="text" name="age" pattern="[0-9]{2}" required> 
          </div>
        </div>

        <!-- 使用機材 -->
        <div class="margin-b-50px">
          <div>
            <label>使用機材</label>
            <input id="eqp" type="radio" name="eqp" value="headphone">有線ヘッドホン
            <input id="eqp" type="radio" name="eqp" value="earphone" required>有線イヤホン<br>
            <span class="font-14px-red">スピーカー、無線ヘッドホン、無線イヤホンの使用はご遠慮ください</span>
          </div>
          <div class="margin-tb-2per">
            <label>わかる範囲でメーカーや型番</label>
            <input id="eqpinfo" type="text" name="eqpinfo" required>
          </div>
        </div>

        <!-- 使用PC -->
        <div class="margin-b-50px">
          <div>
            <label>パソコン</label>
            <input id="pc" type="radio" name="pc" value="windows" onclick="checkpc()" required>Windows
            <input id="pc" type="radio" name="pc" value="mac"onclick="checkpc()">Mac
            <input id="pc" type="radio" name="pc" value="other"onclick="checkpc()">その他&nbsp;<input id="pcinfo" type="text" name="pcinfo" disabled style="display:none;"><br>
            <span class="font-14px-red">スマホやタブレットの使用はご遠慮ください</span>
          </div>
        </div>

        <!-- 母語 -->
        <div class="margin-b-50px">
          <div>
            <label>母語</label>
            <input id="lang" type="radio" name="lang" value="japanese" onclick="checklang()" required>日本語
            <input id="lang" type="radio" name="lang" value="other" onclick="checklang()">その他&nbsp;<input id="langinfo" type="text" name="langinfo" disabled style="display:none;">
          </div>
        </div>

        <!-- 耳の聞こえ -->
        <div class="margin-b-50px">
          <div>
            <label>耳が遠いと感じたり、言われたことがありますか？</label>
            <input id="hear" type="radio" name="hear" value="HL">はい
            <input id="hear" type="radio" name="hear" value="no" required>いいえ<br>
            <span class="font-14px-red">「はい」と答えた場合も参加できます。</span>
          </div>
        </div>

          <p>これから先はブラウザの戻るボタンを使わないでください。</p>
          <p>実験が正しく行えなくなります。</p>

      <div class="margin-b-30px">
        <button type=“submit” class="btn"><div class="label">完了</button>
      </div>
      </form>
    </section>

    <script langage="javascript" type="text/javascript">

      function checkname(input) {
        if (input.value != document.getElementById('id').value) {
          input.setCustomValidity("ユーザー名に間違いがないか確認してください");
        } else {
          input.setCustomValidity("");
        }
      }

      // 「その他」のラジオボタンをクリックしたときにテキストボックスを有効化
      function checkpc(){
        if(document.sbjinfo["pc"][2].checked ) {
          document.sbjinfo["pcinfo"].disabled = false;
          document.getElementById('pcinfo').style.display = "inline";
         }else{
          document.sbjinfo["pcinfo"].disabled = true;
        }
      }

      function checklang(){
        if(document.sbjinfo["lang"][1].checked ) {
          document.sbjinfo["langinfo"].disabled = false;
          document.getElementById('langinfo').style.display = "inline";
         }else{
          document.sbjinfo["langinfo"].disabled = true;
        }
      }
    </script>

    <hr />
    <footer>
      <p><?php echo $footer; ?></p>
    </footer>
  </body>
</html>