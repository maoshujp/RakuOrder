<?php

try {

    // データベースに接続
    // ページに接続する

    /* データベースから値を取ってきたり， データを挿入したりする処理 */
    // SQL作成
    $sql  = " select m.invoice_id , t.meisai_id,mm.menu_name,mm.filename,mm.menu_price,t.menu_quant,t.status from pre_jtc_restaurant_sale_m m " ;
    $sql .= " left join pre_jtc_restaurant_sale_t t on m.invoice_id = t.invoice_id and m.shop_id = t.shop_id ";
    $sql .= " left join pre_jtc_restaurant_menu_m mm on mm.shop_id = t.shop_id and mm.cate_id = t.cate_id and mm.menu_id = t.menu_id ";
    $sql .= " where t.status <> '9' ";//キャンセル済み
    $sql .= " and m.shop_id = '".$shop_id."' ";
    $sql .= " and m.table_id = '".$table_id."' ";
    $sql .= " and m.invoice_id = '".$invoice_id."' ";
    $sql .= " order by t.meisai_id desc,mm.cate_id,mm.e_sort asc ";

    // SQL実行
    $res = $pdo->query($sql);


} catch (PDOException $e) {
    exit($e->getMessage()); 

}

?>