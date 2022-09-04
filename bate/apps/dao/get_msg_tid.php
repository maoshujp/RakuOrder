<?php

try {
    // データベースに接続 
    // ページに接続する

    /* データベースから値を取ってきたり， データを挿入したりする処理 */
    // SQL作成
    $sql = " select distinct table_id from pre_jtc_restaurant_msg_t where shop_id =  '".$shop_id."' and status = '0' order by create_date asc "; 

    
    // SQL実行
    $res = $pdo->query($sql);


} catch (PDOException $e) {


    exit($e->getMessage()); 

}
?>