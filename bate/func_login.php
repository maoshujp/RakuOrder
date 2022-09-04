<!DOCTYPE html>
<html>
<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link href="css/mui.min.css" rel="stylesheet" />
    <link rel="icon" href="images/icon.jpg" type="image/jpg">
    <style>
        #nav {
            background: #CF2D28;
        }

        #nav a {
            color: #FFFFFF;
            display: block;
            text-align: center;
            line-height: 50px;
        }

        .mui-content {
            padding: 1%;
        }

        .addressform>form>div {
            border-bottom: 1px solid #CCCCCC
        }

        .addressform>form>div>input {
            font-size: 13px;
            margin: 0;
        }

        .addressform>form>div>input[type="button"] {
            padding: 2px 4px;
            margin-top: 2%;
        }
    </style>
</head>

<body>
    <?php
    //URLパラメータを取得する
    $shop_id = $_GET['sid'];
    $_SESSION['sid'] = $shop_id;
    // データベースに接続
    include './apps/dao/db_access.php';
    //ショップ情報を取得する
    include './apps/dao/get_shop_name.php';
    $_SESSION['shop_nm'] = $shop_nm;
    ?>
    <form action="logic_chkAuthority.php" method="POST">
        <header class="mui-bar mui-bar-nav header">
            <h1 class="mui-title"><?= htmlspecialchars($shop_nm) ?></h1>
        </header>
        <!--头部-->
        <div class="mui-content addressform">
            <div style="border-bottom: 1px solid #CCCCCC;height:50px;line-height:50px;text-align:center;">
                <b>楽々注文</b>
            </div>
            <div style="border-bottom: 1px solid #CCCCCC;">
                ユーザID：<input type="text" name="uid" id="uid" style="width: 80%;border: none;background: #EFEFF4;font-size: 20px;" maxlength="12" />
            </div>
            <div style="border-bottom: 1px solid #CCCCCC;">
                暗証番号：<input type="password" name="pwd" id="pwd" style="width: 40%;border: none;background: #EFEFF4;font-size: 20px;" maxlength="4" />
            </div>
        </div>
        <?php
        if ($_SESSION['err_id'] != null && $_SESSION['err_id'] != "") {
        ?>
            <div>
                <p class="mui-pull-right">
                    <font color="red">ユーザIDまたはパスワードが正しくない。</font>
                </p>
            </div>
            <div><a class="mui-pull-right" href="index.html">暗証番号が忘れた？</a></div>
        <?php
        }
        ?>
        <nav class="mui-bar mui-bar-tab " id="nav">
            <input type="submit" id="log_btn" value="ログイン" class="mui-bottom mui-btn-block" style="background: #CF2D28;height: 60px;border:none;color:write;" />
        </nav>
        <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" charset="utf-8">
            //ログインチェック
            $('#log_btn').click(function() {
                var uid = $('#uid').val();
                var pwd = $('#pwd').val();
                if (!uid) {
                    alert('ユーザIDを入力してください。');
                    $('#uid').focus();
                    return false;
                }
                if (!pwd) {
                    alert('暗証番号を入力してください。');
                    $('#pwd').focus();
                    return false;
                }

            });
        </script>
    </form>
</body>

</html>