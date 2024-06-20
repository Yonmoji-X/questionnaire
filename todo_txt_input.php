<?php
$get_ag = '';
$get_disag = '';
$get_ag_count = 0;
$get_disag_count = 0;

$array = [];
$file = fopen('data/question.txt', 'r');
// var_dump($file);
// exit();
flock($file, LOCK_EX);

if($file){
  while($line = fgets($file)){
    // var_dump($line);
    // exit();
    $line = trim($line);
    if($line == "ag") {
      $get_ag .= "<td>🙆‍♀️</td>";
      $get_ag_count++;
      // $get_ag .= "<td>{$line}</td>";
    } elseif ($line == "disag") {
      $get_disag .= "<td>🙅‍♂️</td>";
      $get_disag_count++;
      // $get_disag .= "<td>{$line}</td>";
    };

  }
}

// ロック解除
flock($file, LOCK_UN);
// ファイル閉じる
fclose($file);

// echo '<pre>';
// var_dump($array);
// echo '</pre>';
// exit();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>textファイル書き込み型todoリスト（入力画面）</title>
</head>

<body>
  <!-- <p>https://www.youtube.com/live/NEaXjk9dudk</p> -->
  <form action="todo_txt_create.php" method="POST">
    <fieldset>
      <legend>投票</legend>
      <!-- <a href="todo_txt_read.php">一覧画面</a> -->
      <!-- <div>
        todo: <input type="text" name="todo">
      </div>
      <div>
        deadline: <input type="date" name="deadline">
      </div> -->
      <div>
        賛: <input type="radio"  name="ag">
      </div>
      <div>
        反: <input type="radio" name="disag">
      </div>
      <div>

      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>
  <fieldset>
    <legend>結果</legend>
    <!-- <a href="todo_txt_input.php">入力画面</a> -->
    <table>
      <thead>
        <tr>
          <th></th>
        </tr>
      </thead>

      <tbody>
        <?= $str ?>
        <!-- <tbody> -->
        <tr>
          <th scope="row">賛：</th>
          <?= $get_ag ?>
          <th>(<?= $get_ag_count ?>)</th>
        </tr>
        <tr>
          <th scope="row">反：</th>
          <?= $get_disag ?>
          <th>(<?= $get_disag_count ?>)</th>
        </tr>
      </tbody>
    </table>
  </fieldset>
  <script>
    const get_ag = <?= json_encode($get_ag) ?>;
    console.log(get_ag);
    const get_disag = <?= json_encode($get_disag) ?>;
    console.log(get_disag);
    // const array = <?= json_encode($array) ?>;
    // console.log(array);

    // const data = [

  </script>

</body>

</html>
