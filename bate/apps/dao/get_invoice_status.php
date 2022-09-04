<?php

try {
    // データベースに接続 
    // ページに接続する

    /* データベースから値を取ってきたり， データを挿入したりする処理 */
    // SQL作成
    //ステータス：8 会計依頼
    $sql = " select count(*) invoice_status8_count from pre_jtc_restaurant_sale_m where shop_id =  '" . $shop_id . "' and status = '8' ";


    // SQL実行
    $res = $pdo->query($sql);

    $invoice_status8_count = 0;

    foreach ($res as $value) {
        $invoice_status8_count = $value['invoice_status8_count'];
    }
} catch (PDOException $e) {


    exit($e->getMessage());
}
?>