<?php

try {

    // データベースに接続 
    // ページに接続

    /* データベースから値を取ってきたり， データを挿入したりする処理 */
    // SQL作成
    $sql = " select shop_nm from pre_jtc_shop_m where shop_id =  '".$shop_id."'"; 

    
    // SQL実行
    $res = $pdo->query($sql);

    foreach ($res as $value) {
        $shop_nm = $value["shop_nm"];
    }

} catch (PDOException $e) {

    exit($e->getMessage()); 

}
?>