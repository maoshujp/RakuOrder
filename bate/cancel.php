<!DOCTYPE html>
<html>
<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <title>ご注文情報</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link href="css/mui.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/iconfont.css" />
    <link rel="icon" href="images/icon.jpg" type="image/jpg">
    <style>

    </style>
</head>

<body>
    <header class="mui-bar mui-bar-nav s_header">
        <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" href="indent.php"></a>
        <h1 class="mui-title">ご注文情報</h1>
        <a href="news.html"><i class="mui-icon mui-icon-chat"></i></a>
    </header>
    <!--ヘッダ-->
    <div class="mui-content shopping">
        <div class="mui-row option">
            <div class="mui-col-xs-3 ">
                <a href="indent.php">注文履歴</a>
            </div>
            <div class="mui-col-xs-3 ">
                料理中
            </div>
            <div class="mui-col-xs-3 ">
                提供済
            </div>
            <div class="mui-col-xs-3 s_Add">
                キャンセル
            </div>
        </div>
        <div class="mui-row">
            <!-- キャンセル -->
            <div class="col-xs-12 spbox shbox-two">
                <ul class="mui-table-view">
                    <?php
                    //システム日付
                    include './apps/com/com_system_date.php';
                    // データベースに接続
                    include './apps/dao/db_access.php';

                    //キー項目
                    $invoice_id = $_SESSION['iid'];
                    $shop_id = $_SESSION['sid'];
                    $table_id =  $_SESSION['tid'];
                    $meisai_id = $_GET['meisai_id'];
                    
                    //ステータス：9(キャンセル)
                    $status = "9";
                    $description = "Order Cancel at:" . $today;

                    //共通項目
                    $update_user = "Custom";
                    $update_date = $today;
                    $update_program_id = "cancel";

                    //キャンセル処理
                    include './apps/dao/set_invoice_meisai_status.php';
                    //データを再取得
                    $meisai_id_search = $meisai_id;
                    include './apps/dao/get_pre_jtc_restaurant_sale_t_status.php';
                    foreach ($res as $value) {
                    ?>
                        <li class="mui-table-view-cell mui-media">
                            <a href="#">
                                <img class="mui-media-object mui-pull-left" src="<?= htmlspecialchars($value['filename']) ?>">
                                <div class="mui-media-body">
                                    <?= htmlspecialchars($value['menu_name']) ?><small class="mui-pull-right">&nbsp;</small>
                                    <p class='mui-ellipsis'>数量：<span><span><?= htmlspecialchars($value['menu_quant']) ?></span></p>
                                </div>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    $res = null;
                    //接続を閉じる
                    $pdo = null;
                    ?>

                </ul>
            </div>
            <div class="col-xs-12 spbox">
                <div class="mui-col-xs-12 border-bottom_1"> <span class="mui-pull-right"></span></div>
                <div class="mui-col-xs-12">
                    <font color="red">上記ご注文がキャンセルされました！</font><br />
                    <div class="mui-row border-bottom_1">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="mui-bar mui-bar-tab " id="nav">
        <a class="mui-tab-item " id="a1" href="classify.php?sid=<?= htmlspecialchars($shop_id) ?>&tid=<?= htmlspecialchars($table_id) ?>">
            <span class="mui-icon icon iconfont icon-diancan"></span>
            <span class="mui-tab-label">追加注文</span>
        </a>
        <a class="mui-tab-item mui-active" id="a2" href="indent.php">
            <span class="mui-icon icon iconfont icon-viewlist"></span>
            <span class="mui-tab-label">注文履歴</span>
        </a>
        <a class="mui-tab-item " id="a3" href="shopping.php">
            <span class="mui-icon icon iconfont icon-order"></span>
            <span class="mui-tab-label">お会計</span>
        </a>
        <a class="mui-tab-item " id="a3" href="#">
            <span class="mui-icon icon iconfont icon-kefu"></span>
            <span class="mui-tab-label">店員呼出</span>
        </a>
    </nav>
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/browser-back.js"></script>
    <script type="text/javascript" src="js/browser-reload.js"></script>
</body>

</html>