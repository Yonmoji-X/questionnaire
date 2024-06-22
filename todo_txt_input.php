<?php
$get_ag = '';
$get_disag = '';
$get_ag_count = 0;
$get_disag_count = 0;

$file = fopen('data/question.txt', 'r');
flock($file, LOCK_EX);

if ($file) {
    while ($line = fgets($file)) {
        $line = trim($line);
        if ($line == "ag") {
            $get_ag .= "<td>🙆‍♀️</td>";
            $get_ag_count++;
        } elseif ($line == "disag") {
            $get_disag .= "<td>🙅‍♂️</td>";
            $get_disag_count++;
        }
    }
}

flock($file, LOCK_UN);
fclose($file);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <title>textファイル書き込み型todoリスト（入力画面）</title>
</head>
<body>
    <form action="todo_txt_create.php" method="POST">
        <fieldset>
            <legend>投票</legend>
            <div>
                賛: <input type="radio" name="ag">
            </div>
            <div>
                反: <input type="radio" name="disag">
            </div>
            <div>
                <button>submit</button>
            </div>
        </fieldset>
    </form>
    <fieldset>
        <legend>結果</legend>
        <table>
            <thead>
                <tr><th></th></tr>
            </thead>
            <tbody>
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
    <canvas id="myPieChart"></canvas>
    <script>
        const get_ag_count = <?= json_encode($get_ag_count) ?>;
        const get_disag_count = <?= json_encode($get_disag_count) ?>;

        const ctx = document.getElementById("myPieChart").getContext("2d");
        const myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["賛成", "反対"],
                datasets: [{
                    backgroundColor: ["#BB5179", "#FAFF67"],
                    data: [get_ag_count, get_disag_count]
                }]
            },
            options: {}
        });
    </script>
</body>
</html>
