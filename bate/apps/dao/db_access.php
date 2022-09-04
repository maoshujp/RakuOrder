<?php
    /* リクエストから得たスーパーグローバル変数をチェックするなどの処理 */
    // データベースに接続
    $pdo = new PDO(
        'mysql:dbname=snk-ri45;host=210.209.125.41;charset=utf8',
        'snk-ri45',
        'sinocom11#',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
?>