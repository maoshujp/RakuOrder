<!DOCTYPE html>
<html>
<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <title>レジ</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link href="css/mui.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/iconfont.css" />
    <link rel="icon" href="images/icon.jpg" type="image/jpg">
    <style>
        * {
            font-size: 14px;
            line-height: 3em;
        }

        .mui-content>.mui-row>.mui-col-xs-12:first-child {
            font-size: 18px;
            color: #56AA2E;
            text-align: center;
        }

        .mui-content>.mui-row>.mui-col-xs-12:first-child>span {
            font-size: 18px;
            font-weight: bold;
            color: #56AA2E;
        }

        .mui-table-view li a img {
            width: 6%;
            margin-right: 5%;
        }

        .mui-table-view li a {
            line-height: 2em;

        }

        .mui-content>.mui-row>.mui-col-xs-12:last-child a button {
            width: 100%;
            background: #EC971F;
            color: #FFFFFF;
            margin-top: 1%;
            padding: 2.5% 0;
        }
    </style>
</head>

<body>
    <form>
        <header class="mui-bar mui-bar-nav">
            <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" href="integral.php"></a>
            <h1 class="mui-title">レジ情報</h1>
        </header>
        <!--头部-->
        <div class="mui-content">
            <div class="mui-row">
                <div class="mui-col-xs-12"><span class="icon iconfont icon-selected"></span>レジへお会計お願いします。</div>
                <?php
                //システム日付
                include './apps/com/com_system_date.php';
                // データベースに接続
                include './apps/dao/db_access.php';

                //キー項目
                $invoice_id = $_SESSION['iid'];
                $shop_id = $_SESSION['sid'];
                $table_id =  $_SESSION['tid'];
                //合計金額
                $pay_price = $_POST["pay_price"];
                //ステータス：8(会計依頼)
                $status = "8";
                $description = "Pay at:" . $today;
                //共通項目
                $update_user = "Custom";
                $update_date = $today;
                $update_program_id = "pay";

                // レジ処理
                include './apps/dao/set_invoice_status.php';
                ?>
                <div class="mui-col-xs-12">テーブル：<span><?= htmlspecialchars($table_id) ?></span></div>
                <div class="mui-col-xs-12">合計：<span>￥<?= number_format(floor($pay_price)) ?></span></div>
                <div class="mui-col-xs-12">支払方法は下記となります。</div>
                <div class="mui-col-xs-12">
                    <div class="mui-row">
                        <div class="mui-col-xs-12">
                            <ul class="mui-table-view mui-table-view-radio">
                                <li class="mui-table-view-cell mui-selected">
                                    <a class="mui-navigate-right">
                                        <img src="images/hy.png" alt="" />現金
                                    </a>
                                </li>
                                <li class="mui-table-view-cell">
                                    <a class="mui-navigate-right">
                                        <img src="images/wx.png" />微信
                                    </a>
                                </li>
                                <li class="mui-table-view-cell">
                                    <a class="mui-navigate-right">
                                        <img src="images/zfb.png" />支付宝
                                    </a>
                                </li>
                                <li class="mui-table-view-cell">
                                    <a class="mui-navigate-right">
                                        <img src="images/ye.png" alt="" />クレジットカード
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--
                <div class="mui-col-xs-12"><a href="index.html"><button>去支付</button></a></div>
                    -->
                </div>
            </div>
            <script src="js/mui.js"></script>
            <script type="text/javascript" charset="utf-8">
                /*mui.init();
				      	mui('body').on('tap','a',function(){document.location.href=this.href;});  
				      	*/
            </script>
    </form>
</body>

</html>