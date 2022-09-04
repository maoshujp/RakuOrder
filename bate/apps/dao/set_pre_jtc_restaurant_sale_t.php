<?php

try {
    // ページに接続する

    /* データベースから値を取ってきたり， データを挿入したりする処理 */
    // SQL作成
    $stmt = $pdo->prepare("INSERT INTO pre_jtc_restaurant_sale_t 
    (invoice_id,meisai_id,shop_id,cate_id,menu_id,menu_price,menu_quant,status,description,create_user,create_date,create_program_id,update_user,update_date,update_program_id) 
    VALUES (
        :invoice_id, :meisai_id, :shop_id,:cate_id,:menu_id,:menu_price,:menu_quant,:status,:description,:create_user,:create_date,:create_program_id,:update_user,:update_date,:update_program_id
    )");

    // 登録するデータをセット
    $stmt->bindParam(':invoice_id', $invoice_id, PDO::PARAM_STR);
    $stmt->bindParam(':meisai_id', $meisai_id, PDO::PARAM_INT);
    $stmt->bindParam(':shop_id', $shop_id, PDO::PARAM_STR);
    $stmt->bindParam(':cate_id', $cate_id, PDO::PARAM_STR);
    $stmt->bindParam(':menu_id', $menu_id, PDO::PARAM_STR);
    $stmt->bindParam(':menu_price', $menu_price, PDO::PARAM_INT);
    $stmt->bindParam(':menu_quant', $menu_quant, PDO::PARAM_INT);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);

    //共通項目
    $stmt->bindParam(':create_user', $create_user, PDO::PARAM_STR);
    $stmt->bindParam(':create_date', $create_date, PDO::PARAM_STR); 
    $stmt->bindParam(':create_program_id', $create_program_id, PDO::PARAM_STR);

    $stmt->bindParam(':update_user', $update_user, PDO::PARAM_STR);
    $stmt->bindParam(':update_date', $update_date, PDO::PARAM_STR); 
    $stmt->bindParam(':update_program_id', $update_program_id, PDO::PARAM_STR);

    // SQL実行
    $res = $stmt->execute();

} catch (PDOException $e) {

    exit($e->getMessage());
}