<?php

try {
    // データベースに接続 
    // ページに接続する

    /* データベースから値を取ってきたり， データを挿入したりする処理 */
    // SQL作成
    //ステータス：0 未処理
    $sql = " select count(*) msg_status0_count from pre_jtc_restaurant_msg_t where shop_id =  '" . $shop_id . "' and status = '0' ";


    // SQL実行
    $res = $pdo->query($sql);

    $msg_status0_count = 0;

    foreach ($res as $value) {
        $msg_status0_count = $value['msg_status0_count'];
    }
} catch (PDOException $e) {


    exit($e->getMessage());
}
?>