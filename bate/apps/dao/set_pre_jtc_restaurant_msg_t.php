<?php

try {

    // ページに接続する

    /* データベースから値を取ってきたり， データを挿入したりする処理 */
    // SQL作成
    $stmt = $pdo->prepare("INSERT INTO pre_jtc_restaurant_msg_t 
    (invoice_id,shop_id,table_id,meisai_id,msg_id,msg_memo,status,description,create_user,create_date,create_program_id,update_user,update_date,update_program_id) 
    VALUES (
        :invoice_id, :shop_id,:table_id,:meisai_id,:msg_id,:msg_memo,:status,:description,:create_user,:create_date,:create_program_id,:update_user,:update_date,:update_program_id
    )");

    // 登録するデータをセット
    $stmt->bindParam(':invoice_id', $invoice_id, PDO::PARAM_STR);
    $stmt->bindParam(':shop_id', $shop_id, PDO::PARAM_STR);
    $stmt->bindParam(':table_id', $table_id, PDO::PARAM_STR);
    $stmt->bindParam(':meisai_id', $meisai_id, PDO::PARAM_INT);

    $stmt->bindParam(':msg_id', $msg_id, PDO::PARAM_STR);
    $stmt->bindParam(':msg_memo', $msg_memo, PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);

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