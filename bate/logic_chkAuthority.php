<!DOCTYPE html>
<html>
<?php
session_start();
?>

<head>
</head>

<body>
    <?php
    $shop_id = $_SESSION['sid'];
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $key = '08095168818';

    //openssl
    $c_t = openssl_encrypt($pwd, 'AES-128-ECB', $key);
    //パスワード暗号化
    $base64_encrypt_string = base64_encode($c_t);
    //復号化
    //$p_t = openssl_decrypt($c_t, 'AES-128-ECB', $key);

    // データベースに接続
    include './apps/dao/db_access.php';

    // ユーザ情報を取得する
    include './apps/dao/get_user_info.php';
    echo $sql . "<br>";
    if ($res->rowCount() > 0) {
        //エラークリア
        unset($_SESSION['err_id']);
        foreach ($res as $value) {
        }
        //画面遷移
        header('Location: func_ctrlPanel.php');
    } else {
        $_SESSION['err_id'] = "ユーザIDまたはパスワードが正しくない。"; //今後code masterに管理する！！！
        //
        $url = 'Location: func_login.php?sid=' . $_SESSION['sid'];
        header($url);
    }
    ?>
</body>

</html>