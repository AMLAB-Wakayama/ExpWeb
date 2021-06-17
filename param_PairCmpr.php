<?php
  // 実験WebPage created by Wakayama Univ. AMLAB
  // パラメータ設定
  // 一対比較実験
  
  // ウェブページタイトル
  $title = '一対比較実験';

  // 英語タイトル
  // 必ずplay_****.phpやready_****.php等の****部分と同じ表記
  $engtitle = 'PairCmpr';

  $task_num = 1; // タスク番号(通常1)
  
  $question_num = 10; // 問題数
  $session_num = 3; // セッション数（練習セッション除く）

  // 実験説明書名 --- instruct.php
  // 同じ名前のテキストファイルとPDFファイル両方を準備 (txt:表示用/pdf:ダウンロード用)
  $instruct = 'Instruction_Example';
  
  // 音量設定用list名 --- setlevel.php
  $list_calib = './list_PairCmpr/ListSnd_Calib.csv';  

  // list名 --- play.php
  // $session は セッション番号を表す (99：練習セッション)
  $list = './list_PairCmpr/ListSnd_PairCmpr_'. $session. '.csv';
  

  // 実験について説明 --- index.php
  $intro = '
    <p>音声の自然さに関する聴取実験です。</p>
    <p>２つの日本語単語のうち、どちらの音声がどれだけ自然なイントネーションに感じたかを選択していただきます。</p>
    <p>静かな環境で実験を実施してください。</p>
  ';


  // 準備物 --- index.php
  $prepare = '
    <div class="index">パーソナルコンピュータ、Google Chromeブラウザ</div>
    <div class="index">有線のヘッドホンまたはイヤホン（スピーカーやBluetooth製品は不可）</div>
  ';

  
  // 実験準備 --- reentry.php
  $reentry = '
    <p>静かな環境でヘッドホンまたはイヤホンを装着し、実験を実施してください。</p>
    <p>２つの日本語単語のうち、どちらの音声がどれだけ自然なイントネーションに感じたかを選択してください。</p>
  ';
?>