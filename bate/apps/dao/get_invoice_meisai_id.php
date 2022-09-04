<?php
try {

    /* データベースから値を取ってきたり， データを挿入したりする処理 */
    // SQL作成
    $sql  = " select max(meisai_id) max_meisai_id from pre_jtc_restaurant_sale_t where ";
    $sql .= " invoice_id = '" . $invoice_id . "' ";
    $sql .= " and shop_id = '" . $shop_id . "' ";

    // SQL実行
    $res = $pdo->query($sql);

    foreach ($res as $value) {
        $meisai_id = $value["max_meisai_id"];
    }
} catch (PDOException $e) {
    exit($e->getMessage());
}
?>