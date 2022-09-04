<?php

try {

    // ページに接続する

    /* データベースから値を取ってきたり， データを挿入したりする処理 */
    // SQL作成
    $stmt = $pdo->prepare("INSERT INTO pre_jtc_restaurant_sale_m 
    (invoice_id,shop_id,table_id,order_start_time,pay_start_time,status,invoice_title,description,create_user,create_date,create_program_id,update_user,update_date,update_program_id) 
    VALUES (
        :invoice_id,  :shop_id,:table_id,:order_start_time,:pay_start_time,:status,:invoice_title,:description,:create_user,:create_date,:create_program_id,:update_user,:update_date,:update_program_id
    )");

    // 登録するデータをセット
    $stmt->bindParam(':invoice_id', $invoice_id, PDO::PARAM_STR);
    $stmt->bindParam(':shop_id', $shop_id, PDO::PARAM_STR);
    $stmt->bindParam(':table_id', $table_id, PDO::PARAM_STR);
    $stmt->bindParam(':order_start_time', $order_start_time, PDO::PARAM_STR);    
    $stmt->bindParam(':pay_start_time', $pay_start_time, PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':invoice_title', $invoice_title, PDO::PARAM_INT);
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