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
        <?php
        //登録フラグ
        $insert_flg = "0"; //0:正常 1:不正
        // POSTされたトークンを取得
        $token = isset($_POST["token"]) ? $_POST["token"] : "";
        // セッション変数のトークンを取得
        $session_token = isset($_SESSION["token"]) ? $_SESSION["token"] : "";
        // セッション変数のトークンを削除
        unset($_SESSION["token"]);
        // POSTされたトークンとセッション変数のトークンの比較
        if ($token != "" && $token == $session_token) {
            // 正常に登録画面送信データの登録を行う

        } else {
            //echo "ERROR：不正な登録処理です";
            $insert_flg = "1";
        }
        //URLキー項目
        $shop_id = $_SESSION['sid'];
        $table_id =  $_SESSION['tid'];
        ?>
        <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" href="classify.php?sid=<?= htmlspecialchars($shop_id) ?>&tid=<?= htmlspecialchars($table_id) ?>"></a>
        <h1 class="mui-title">ご注文履歴</h1>
        <a href="news.html"><i class="mui-icon mui-icon-chat"></i></a>
    </header>
    <!--头部-->
    <div class="mui-content shopping">
        <div class="mui-row option">
            <div class="mui-col-xs-3 ">
                注文履歴
            </div>
            <div class="mui-col-xs-3 ">
                料理中
            </div>
            <div class="mui-col-xs-3 ">
                提供済
            </div>
            <div class="mui-col-xs-3 ">
                キャンセル
            </div>
        </div>
        <div class="mui-row">
            <!-- 注文履歴 -->
            <div class="col-xs-12 spbox">
                <ul class="mui-table-view">
                    <?php
                    //システム日付
                    include './apps/com/com_system_date.php';
                    // データベースに接続
                    include './apps/dao/db_access.php';

                    //注文情報を取得する
                    $i_count = $_SESSION['m_count'];

                    //共通項目
                    $create_user = "Custom";
                    $create_date = $today;
                    $create_program_id = "indent";
            
                    $update_user = "Custom";
                    $update_date = $today;
                    $update_program_id = "indent";

                    //注文マスタ
                    include './apps/dao/get_invoice_id.php';
                    //invoice id
                    $_SESSION['iid'] = $invoice_id;

                    //テーブルの注文状態
                    //明細ID
                    $meisai_id = 0;
                    if ($table_order_status == "1") {
                        //追加注文の場合
                        include './apps/dao/get_invoice_meisai_id.php';
                    }
                    //注文明細に入れる
                    if ($insert_flg == "0") {
                        for ($i = 1; $i < $i_count + 1; $i++) {
                            if ($_POST['menu_quant_' . $i] > 0) {
                                $meisai_id = $meisai_id + 1;
                                $cate_id = $_POST['cate_id_' . $i];
                                $menu_id = $_POST['menu_id_' . $i];
                                $menu_price = $_POST['menu_price_' . $i];
                                $menu_quant = $_POST['menu_quant_' . $i];
                                $status = "0";
                                $description = "Order by sysytem at:" . $today;
                                include './apps/dao/set_pre_jtc_restaurant_sale_t.php';
                            }
                        }
                    }
                    //注文リストを取得する
                    include './apps/dao/get_pre_jtc_restaurant_sale_t.php';
                    foreach ($res as $value) {
                    ?>
                        <li class="mui-table-view-cell mui-media">
                            <img class="mui-media-object mui-pull-left" src="<?= htmlspecialchars($value['filename']) ?>">
                            <div class="mui-media-body">
                                <?= htmlspecialchars($value['menu_name']) ?><small class="mui-pull-right"><!--<?= htmlspecialchars($value['status']) ?>--></small>
                                <p class='mui-ellipsis'>数量：<span><?= htmlspecialchars($value['menu_quant']) ?></span>&nbsp;&nbsp;￥<span><?= htmlspecialchars($value['menu_price']) ?></span></p>
                                <p class='mui-ellipsis'>
                                    <span class="mui-pull-right">
                                        <?php
                                        if ($value['status'] == "0") {
                                        ?>
                                            <a href="cancel.php?meisai_id=<?= htmlspecialchars($value['meisai_id']) ?>" style="color: #0000ff; ">キャンセル</a>
                                        <?php
                                        }
                                        ?>
                                    </span>
                                </p>
                            </div>
                        </li>
                    <?php
                    }
                    // クエリを閉じる
                    //$res = null;
                    ?>
            </div>
            <!-- 料理中 -->
            <div class="col-xs-12 spbox shbox-two">
                <ul class="mui-table-view">
                    <?php
                    $status = "2";
                    include './apps/dao/get_pre_jtc_restaurant_sale_t_status.php';
                    foreach ($res as $value) {
                    ?>
                        <li class="mui-table-view-cell mui-media">
                            <a href="#">
                                <img class="mui-media-object mui-pull-left" src="<?= htmlspecialchars($value['filename']) ?>">
                                <div class="mui-media-body">
                                    <?= htmlspecialchars($value['menu_name']) ?><small class="mui-pull-right">&nbsp;</small>
                                    <p class='mui-ellipsis'>数量：<span><span><?= htmlspecialchars($value['menu_quant']) ?></span></p>
                                    <p class='mui-ellipsis'>￥：<span><?= htmlspecialchars($value['menu_price']) ?></span><span class="mui-pull-right">&nbsp; </span>
                                    </p>
                                </div>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <!-- 提供済み -->
            <div class="col-xs-12 spbox shbox-two">
                <ul class="mui-table-view">
                    <?php
                    $status = "3";
                    //invoice id
                    $_SESSION['iid'] = $invoice_id;
                    include './apps/dao/get_pre_jtc_restaurant_sale_t_status.php';
                    foreach ($res as $value) {
                    ?>
                        <li class="mui-table-view-cell mui-media">
                            <a href="#">
                                <img class="mui-media-object mui-pull-left" src="<?= htmlspecialchars($value['filename']) ?>">
                                <div class="mui-media-body">
                                    <?= htmlspecialchars($value['menu_name']) ?><small class="mui-pull-right">&nbsp;</small>
                                    <p class='mui-ellipsis'>数量：<span><span><?= htmlspecialchars($value['menu_quant']) ?></span></p>
                                    <p class='mui-ellipsis'>￥：<span><?= htmlspecialchars($value['menu_price']) ?></span><span class="mui-pull-right">&nbsp; </span>
                                    </p>
                                </div>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <!-- キャンセル -->
            <div class="col-xs-12 spbox shbox-two">
                <ul class="mui-table-view">
                    <?php
                    $status = "9";
                    //invoice id
                    $_SESSION['iid'] = $invoice_id;
                    include './apps/dao/get_pre_jtc_restaurant_sale_t_status.php';
                    foreach ($res as $value) {
                    ?>
                        <li class="mui-table-view-cell mui-media">
                            <a href="#">
                                <img class="mui-media-object mui-pull-left" src="<?= htmlspecialchars($value['filename']) ?>">
                                <div class="mui-media-body">
                                    <?= htmlspecialchars($value['menu_name']) ?><small class="mui-pull-right">&nbsp;</small>
                                    <p class='mui-ellipsis'>数量：<span><span><?= htmlspecialchars($value['menu_quant']) ?></span></p>
                                    <p class='mui-ellipsis'>￥：<span><?= htmlspecialchars($value['menu_price']) ?></span><span class="mui-pull-right">&nbsp; </span>
                                    </p>
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


        </div>
    </div>
    <nav class="mui-bar mui-bar-tab " id="nav">
        <a class="mui-tab-item " id="a1" href="classify.php?sid=<?= htmlspecialchars($shop_id) ?>&tid=<?= htmlspecialchars($table_id) ?>">
            <span class="mui-icon icon iconfont icon-diancan"></span>
            <span class="mui-tab-label">追加注文</span>
        </a>
        <a class="mui-tab-item mui-active" id="a2" href="indent.php">
            <span class="mui-icon icon iconfont icon-clock"></span>
            <span class="mui-tab-label">履歴更新</span>
        </a>
        <a class="mui-tab-item " id="a3" href="shopping.php">
            <span class="mui-icon icon iconfont icon-order"></span>
            <span class="mui-tab-label">お会計</span>
        </a>
        <a class="mui-tab-item " id="a3" href="sendmsg.php">
            <span class="mui-icon icon iconfont icon-kefu"></span>
            <span class="mui-tab-label">店員呼出</span>
        </a>
    </nav>
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $(".spbox:gt(0)").hide();

            var hd = $(".option div");

            hd.click(function() {

                $(this).addClass("s_Add")

                    .siblings().removeClass("s_Add");

                var sh_index = hd.index(this)

                $(".spbox").eq(sh_index).show(500).siblings().hide(500);

            })
        })
    </script>
    <script type="text/javascript" src="js/browser-back.js"></script>
    <script type="text/javascript" src="js/browser-reload.js"></script>
</body>

</html>