<?php

try {

    // データベースに接続
   // ページに接続する

    /* データベースから値を取ってきたり， データを挿入したりする処理 */
    // SQL作成
    $sql = " select * from pre_jtc_restaurant_table_m where shop_id =  '".$shop_id."'  "; 

    // SQL実行
    $res = $pdo->query($sql);


} catch (PDOException $e) {
    exit($e->getMessage()); 

}

?>