<?php

try {
    // ページに接続する

    /* データベースから値を取ってきたり， データを挿入したりする処理 */
    // SQL作成
    $stmt = $pdo->prepare(" UPDATE pre_jtc_restaurant_sale_m SET status = :status , pay_price = :pay_price , description =:description ,
    update_user = :update_user, update_date = :update_date, update_program_id = :update_program_id
    WHERE invoice_id = :invoice_id  and shop_id = :shop_id and table_id = :table_id ");

    // 登録するデータをセット
    $stmt->bindParam(':invoice_id', $invoice_id, PDO::PARAM_STR);
    $stmt->bindParam(':shop_id', $shop_id, PDO::PARAM_STR);
    $stmt->bindParam(':table_id', $table_id, PDO::PARAM_STR);
    $stmt->bindParam(':pay_price', $pay_price, PDO::PARAM_INT);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);

    $stmt->bindParam(':update_user', $update_user, PDO::PARAM_STR);
    $stmt->bindParam(':update_date', $update_date, PDO::PARAM_STR); 
    $stmt->bindParam(':update_program_id', $update_program_id, PDO::PARAM_STR);


    // SQL実行
    $res = $stmt->execute();

} catch (PDOException $e) {

    exit($e->getMessage());
}