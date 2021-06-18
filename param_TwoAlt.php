<?php
  // 実験WebPage created by Wakayama Univ. AMLAB
  // パラメータ設定
  // 二肢強制選択実験
  
  // ウェブページタイトル
  $title = '二肢強制選択実験';

  // 英語タイトル
  // 必ずplay_****.phpやready_****.php等の****部分と同じ表記
  $engtitle = 'TwoAlt';

  $task_num = 1; // タスク番号(通常1)
  
  $question_num = 10; // 問題数
  $session_num = 3; // セッション数（練習セッション除く）

  // 実験説明書名 --- instruct.php
  // 同じ名前のテキストファイルとPDFファイル両方を準備 (txt:表示用/pdf:ダウンロード用)
  $instruct = 'Instruction_Example';
  
  // 音量設定用list名 --- setlevel.php
  $list_calib = './list_TwoAlt/ListSnd_Calib.csv';

  // list名 --- play.php
  // $session は セッション番号を表す (99：練習セッション)
  $list = './list_TwoAlt/ListSnd_TwoAlt_'. $session. '.csv';

  // 実験について説明 --- index.php
  $intro = '
    <p>男声・女声の判別に関する聴取実験です。</p>
    <p>静かな環境で実験を実施してください。</p>
  ';


  // 準備物 --- index.php
  $prepare = '
    <div class="index">パーソナルコンピュータ、Google Chromeブラウザ</div>
    <div class="index">有線のヘッドホンまたはイヤホン（スピーカーやBluetooth製品は不可）</div>
  ';

  
  // 実験準備 --- reentry.php
  $reentry = 
    '<p>静かな環境でヘッドホンまたはイヤホンを装着し、実験を実施してください。</p>
    <p>流れてくる日本語の音声を男声か女声かを判断し回答してください。</p>
  ';

  // フッター
  $footer = '&copy; 2021 Auditory Media Laboratory';
?>