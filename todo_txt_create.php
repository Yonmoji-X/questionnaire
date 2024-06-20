<?php
// var_dump($_POST);
// exit();
// $agCount = 0;
// $disagCount = 0;
// if($_POST['ag']) {
//   $agCount .= 1;
// }
$ag = $_POST['ag'];
$disag = $_POST['disag'];

// 書き込みたいデータの形
// 2024-06-15 保存処理
// 2024-06-15 表示処理
// 2024-06-15 更新処理
// 2024-06-15 削除処理

//※データの作成方法は毎回これ！
if($ag == 'on' && $disag != 'on') {
  $write_data = "ag\n";
}elseif($disag == 'on' && $ag != 'on') {
  $write_data = "disag\n";
}
//ファイル書き込み。'a'はファイルあったら書き込み、なかったらファイル作って
$file = fopen('data/question.txt', 'a');
// 他の人がファイルいじれないようにロック
flock($file, LOCK_EX);
// fwrite(開くファイル, 書き込む内容);
fwrite($file, $write_data);
// ロック解除
flock($file, LOCK_UN);
// ファイル閉じる
fclose($file);
// 画面の再表示
// header('Location:動かしたいファイル名');
header('Location:todo_txt_input.php');
exit();
