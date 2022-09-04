<?php

/* invoice idを取得する */
$invoice_id = "";

//テーブルオーターステータス デフォルト：1:追加注文
$table_order_status = "1"; //0:新規注文 1:追加注文

try {
    /* データベースから値を取ってきたり， データを挿入したりする処理 */
    // SQL作成
    $sql  = " select invoice_id from pre_jtc_restaurant_sale_m where status = '0' ";
    $sql .= " and shop_id = '" . $shop_id . "' ";
    $sql .= " and table_id = '" . $table_id . "' ";
    // SQL実行
    $res = $pdo->query($sql);

    foreach ($res as $value) {
        $invoice_id = $value["invoice_id"];
    }

    //存在しなかったら、注文を新規作成する
    if ($res->rowcount() < 1) {
        // 0:新規注文
        $table_order_status = "0";
        //注文を新規作成する
        $invoice_id = date('YmdHis');
        //$shop_id セット済み
        //$table_id セット済み
        $order_start_time = date('YmdHis');
        $pay_start_time = null;
        $status = "0";
        $invoice_title = null;
        $description = "Order by system";

        include 'set_pre_jtc_restaurant_sale_m.php';
    }
} catch (PDOException $e) {
    exit($e->getMessage());
}
?>