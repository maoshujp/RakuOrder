<?php
try {

    /* データベースから値を取ってきたり， データを挿入したりする処理 */
    // SQL作成
    $sql  = " select * from pre_jtc_restaurant_user_m where ";
    $sql .= " shop_id = '" . $shop_id . "' ";
    $sql .= " and user_id = '" . $uid . "' ";
    $sql .= " and pwd = '" . $base64_encrypt_string . "' ";
    $sql .= " and lock_flg <> '1' ";

    // SQL実行
    $res = $pdo->query($sql);

} catch (PDOException $e) {
    exit($e->getMessage());
}
