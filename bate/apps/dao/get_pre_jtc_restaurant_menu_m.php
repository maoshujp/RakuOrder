<?php

try {

    // データベースに接続
   // ページに接続する

    /* データベースから値を取ってきたり， データを挿入したりする処理 */
    // SQL作成
    $sql = "select * from pre_jtc_restaurant_menu_m"; 

    // SQL実行
    $res_rm = $pdo->query($sql);


} catch (PDOException $e) {
    exit($e->getMessage()); 

}

?>