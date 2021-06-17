<?php
  // 実験WebPage created by Wakayama Univ. AMLAB
  // IDの保存

  // 新規参加者の登録
  date_default_timezone_set('Asia/Tokyo');

  // ID：性別＋イニシャル＋年齢＋時刻(分)
  // $id = $_POST['gender']. $_POST['name']. $_POST['age'];
  // $id .= (new DateTime())->format('i');

  // 登録時刻
  $now =  (new DateTime())->format('Y-m-d H:i:s');

  // セッション番号
  $session = 99;

  // IDなどの情報をid.csvへ保存
  $data = $id. ",". $now. ",". $_POST['eqp']. ",". $_POST['eqpinfo']. ",". $_POST['pc']. ",". $_POST['pcinfo']. ",". $_POST['lang']. ",". $_POST['langinfo']. ",". $_POST['hear']. "\n";
  $file = fopen('./result/id.csv', 'a');
  fputs($file, $data);
  fclose($file);

  // IDごとの回答フォルダを作成 rw-rw-rw
  $dir = './result/'. $id;
  mkdir($dir, 0777);

  // それぞれの回答フォルダ内にもIDなどの情報をtxtファイルに保存
  $data = "ID: ". $id. "\n";
  $data .= "Equipment: ". $_POST['eqp']. ",". $_POST['eqpinfo']. "\n"; 
  $data .= "PC: ". $_POST['pc']. ",". $_POST['pcinfo']. "\n"; 
  $data .= "Language: ". $_POST['lang']. ",". $_POST['langinfo']."\n";
  $data .= "HearingLoss_Suspection: ". $_POST['hear']. "\n";
  $data .= "Start: ". $now. "\n";
  $file = fopen('./result/'. $id. '/'. $id. '_info.txt', 'w');
  fputs($file, $data);
  fclose($file);
?>