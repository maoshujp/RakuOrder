<?php

try {
    /* データベースから値を取ってきたり， データを挿入したりする処理 */
    // SQL作成
    $sql .= " select it.invoice_id,mm.menu_name,mm.menu_id,mm.cate_id,it.menu_quant_max,it.menu_price,it.menu_price_max from pre_jtc_restaurant_sale_m im ";
    $sql .= " left join ";
    $sql .= " (select shop_id,invoice_id,cate_id,menu_id,menu_price,sum(menu_quant*menu_price) menu_price_max,sum(menu_quant) menu_quant_max from pre_jtc_restaurant_sale_t  ";
    $sql .= " where shop_id = '" . $shop_id . "' ";
    $sql .= " and status = '3' ";//提供済み
    $sql .= " group by shop_id,invoice_id,cate_id,menu_id) it ";
    $sql .= " on im.invoice_id =  it.invoice_id ";
    $sql .= " left join pre_jtc_restaurant_menu_m mm ";
    $sql .= " on it.shop_id = mm.shop_id ";
    $sql .= " and it.cate_id = mm.cate_id ";
    $sql .= " and it.menu_id = mm.menu_id ";
    $sql .= " where im.invoice_id =  '" . $invoice_id . "'  ";
    $sql .= " and im.table_id = '" . $table_id . "' ";
    // SQL実行
    $res = $pdo->query($sql);

} catch (PDOException $e) {
    exit($e->getMessage());
}
?>