<!-- 実験WebPage created by Wakayama Univ. AMLAB -->
<!-- 音声聴取（二肢強制選択） -->
<!DOCTYPE html>
<html>
	<head>
		<title>Web聴取実験</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" type="text/css" href="./ExpWeb.css">
    <link rel="stylesheet" type="text/css" href="./ExpWeb_TwoAlt.css">
	</head>
	<body>
		<?php
				$id = $_POST['id'];
				$session = $_POST['session'];
				require('./param.php');
		?>
		
		<header>
			<h1><?php echo $title ?></h1>
			<div class="header-right"><?php 
				if($session == 99){
					print 'ID:'. $id. '　'. 'Session Practice';
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

			<p>準備が完了したらスタートボタンを押してください</p>
			<p>"音声スタート"ボタンを押すと音声が流れます</p>
			<p>その音声が男声・女声のどちらに聞こえるか判断し、選択してください</p>


			<button id="play" class="btn" onclick="getCsvData('<?php echo $list; ?>');disabled = true ">音声スタート</button>
				<div class="margin-tb-2per">
				<div><span id = "qnum">1問</span>&nbsp;/&nbsp;<?php print $question_num; ?>問</div>
				<div class="flex">
				<button class="btn" id="m_btn" name="m" onclick="CountUp(0)" disabled>男声</button>
				<button class="btn" id="f_btn" name="f" onclick="CountUp(1)" disabled>女声</button>
				</div>
			</div>

			<form action="end.php" method="POST" name="form">
				<?php for($i=1; $i<=$question_num; $i++): ?>
            <input type="hidden" name="answer<?php echo $i;?>" value>
            <input type="hidden" name="filename<?php echo $i;?>" value>
        <?php endfor; ?>
        
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="session" value="<?php echo $session; ?>">
        <button type=“submit” class="btn" id="next"><div class="label">実験完了！</div></button>
			</form>
		</section>

		<script language="javascript" type="text/javascript">

			document.getElementById("next").style.visibility ="hidden";
			const dataArray = [];　// リスト用配列

			//問題番号の管理
			let index = 0;

			//CSVファイルの読み込み
	    function getCsvData(dataPath) {
				const request = new XMLHttpRequest();
				request.addEventListener('load', (event) => {
					const response = event.target.responseText;
					convertArray(response);
				});
				request.open('GET', dataPath, true);
				request.send();
	    }

			//CSVファイルのデータを配列に格納
			function convertArray(data) {
				const dataString = data.split('\n');
				for (let i = 0; i < dataString.length; i++){
					dataArray[i] = dataString[i].split(',');
				}
				play(dataArray);
			}

			// 再生
			function play(playList) {
				var audio = new Audio();
				audio.src = playList[index];
				audio.play();

				audio.addEventListener('ended', function(){
					document.getElementById("m_btn").disabled=false;
					document.getElementById("f_btn").disabled=false;
				});
				document.form.elements["filename"+(index+1)].value = playList[index];
			}

			//問題数のカウント
			var count = 2;
			function CountUp(value){
				document.getElementById("m_btn").disabled=true;
				document.getElementById("f_btn").disabled=true;

				index++;
				document.form.elements["answer"+index].value = value;

				if(count <= <?php echo $question_num;?>){
					document.getElementById("qnum").innerHTML = count+"問";  
					count += 1;
					play(dataArray);
				}else{
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