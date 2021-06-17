<?php
  // 実験WebPage created by Wakayama Univ. AMLAB
  // 設定音圧の保存
 

  // 新規参加者の登録
  // date_default_timezone_set('Asia/Tokyo');

  // ID：性別＋イニシャル＋年齢＋時刻(分)
  // $id = $_POST['gender']. $_POST['name']. $_POST['age'];
  // $id .= (new DateTime())->format('i');

  // 登録時刻
  // $now =  (new DateTime())->format('Y-m-d H:i:s');

  // IDなどの情報をid.csvへ保存
  $data = $id. ",". $_POST['sndlevel'];
  if($task_num != 1){
    $data .= ",". $_POST['levelchange'];
  }
  $data .= "\n";
  $file = fopen('./result/id_sndlevel.csv', 'a');
  fputs($file, $data);
  fclose($file);

  // それぞれの回答フォルダ内にも情報をtxtファイルに保存
  $data = "Sound Set Level: ". $_POST['sndlevel']. "\n";
  $file = fopen('./result/'. $id. '/'. $id. '_info.txt', 'a');
  fputs($file, $data);
  fclose($file);
?>