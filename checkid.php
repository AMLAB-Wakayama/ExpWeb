<?php
  // 実験WebPage created by Wakayama Univ. AMLAB
  // 実験参加者のチェック
  
  // echo "<script>console.log('この参加者のIDは、$id');</script>";
  $error = 0;

  // 参加をお断りする人をチェック
  foreach(glob("./result/id_reject.csv") as $filename) {
    $file = fopen($filename, "r");

    while(($sbjdata = fgetcsv($file)) !== false) {
      $sbjid = $sbjdata[0];
      if(strcmp($sbjid, $id) == 0){ 
        $error = 1;
        break;
      }
    }
    fclose($file);
  }

  // Task2以降、前タスク参加者かチェック
  if($task_num != 1){
    foreach(glob("./result/id_sndlevel.csv") as $filename) {
      $file = fopen($filename, "r");
      $error = 2;

      while(($sbjdata = fgetcsv($file)) !== false) {
        $sbjid = $sbjdata[0];
        if(strcmp($sbjid, $id) == 0){ 
          $error = 0;
          $sndlevel = $sbjdata[1];
          break;
        }
      }
      fclose($file);
    }
  }

  // 実験途中でないかチェック
  foreach(glob("./result/". $id. "/") as $result) {
    $error = 3;
  }
?>