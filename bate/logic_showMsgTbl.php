<!DOCTYPE html>
<html>
<?php
session_start();
?>

<head>
    <link href="css/style-eff.css" rel="stylesheet" />
</head>

<body>
    <?php
    $shop_id = $_SESSION['sid'];
    // データベースに接続
    include './apps/dao/db_access.php';
    //テーブルIDを取得
    include './apps/dao/get_msg_tid.php';

    foreach ($res as $value) {
        //テーブルID
        $table_id[] = $value['table_id'];
    }
    // クエリーを閉じる
    $res = null;
    ?>

    <!-- 1番目の-->
    <?php
    if (count($table_id) > 0) {
    ?>
       <h1><?= htmlspecialchars($table_id[0]) ?></h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php
    }
    ?>
    <!-- 2番目以降-->
    <?php

    for ($i = 1; $i < count($table_id); $i++) {
        //2番目からのテーブルID
        $table_id_msg =  $table_id[$i] . "&nbsp;&nbsp;";

    ?>
        <h2 style="color: #fff6a9;font-size: 28px;line-height:28px"><?= $table_id_msg ?></h2>
    <?php
    }
    ?>

</body>

</html>