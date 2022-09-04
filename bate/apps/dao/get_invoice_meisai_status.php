<?php

try {
    // データベースに接続 
    // ページに接続する

    /* データベースから値を取ってきたり， データを挿入したりする処理 */
    // SQL作成
    //ステータス：2 配膳可
    $sql = " select count(*) menu_status2_count from pre_jtc_restaurant_sale_t where shop_id =  '" . $shop_id . "' and status = '2' ";


    // SQL実行
    $res = $pdo->query($sql);

    $menu_status2_count = 0;

    foreach ($res as $value) {
        $menu_status2_count = $value['menu_status2_count'];
    }
} catch (PDOException $e) {


    exit($e->getMessage());
}
?>