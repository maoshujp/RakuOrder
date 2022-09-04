<?php

try {

    // データベースに接続
    // ページに接続する

    /* データベースから値を取ってきたり， データを挿入したりする処理 */
    // SQL作成
    $sql = "select cate_id,menu_id,menu_name,menu_name_cn,menu_name_en,filename,menu_price from pre_jtc_restaurant_menu_m where shop_id = '".$shop_id."'";
    $sql .=" and cate_id = '".$cate_id."'"; 

    // SQL実行
    $res_rm = $pdo->query($sql);
    
} catch (PDOException $e) {
    exit($e->getMessage()); 

}

?>