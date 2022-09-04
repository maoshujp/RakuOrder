<!DOCTYPE html>
<html>
<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <title>お会計</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link href="css/mui.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="icon" href="images/icon.jpg" type="image/jpg">
    <style>
        .mui-numbox .mui-numbox-input {
            border-right: none;
            border-left: none;
        }


        .mui-numbox .mui-numbox-input {
            border-left: none !important;
            border-right: none !important;
        }
    </style>
</head>

<body>
    <form action="pay.php" method="POST">
        <header class="mui-bar mui-bar-nav s_header">
            <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" href="indent.php"></a>
            <h1 class="mui-title">お会計リスト</h1>
            <a href="news.html"><i class="mui-icon mui-icon-chat"></i></a>
        </header>
        <!--头部-->
        <?php
        //キー項目
        $shop_id = $_SESSION['sid'];
        $table_id = $_SESSION['tid'];
        $invoice_id  = $_SESSION['iid'];
        ?>
        <div class="mui-content shopping">
            <div class="mui-row option">
                <div class="mui-col-xs-6 ">
                    テーブル：<b><?= htmlspecialchars($table_id) ?></b>
                </div>
                <div>
                    割勘：<input class="mui-numbox-input" type="number" id="c_count_txt" min="1" max="100" style="width: 15%;" />人
                </div>
            </div>
            <div class="mui-row">
                <div class="col-xs-12 spbox">
                    <div class="mui-col-xs-12 border-bottom_1">
                        <?php
                        //キー項目
                        //$shop_id = $_SESSION['sid'];
                        //$table_id = $_SESSION['tid'];
                        //$invoice_id  = $_SESSION['iid'];

                        //合計価格
                        $price_count = 0;

                        // データベースに接続
                        include './apps/dao/db_access.php';
                        //ショップ情報を取得する
                        include './apps/dao/get_invoice_price.php';
                        foreach ($res as $value) {
                            $price_count = $price_count + $value['menu_price_max'];
                        ?>
                            <div class="mui-row">
                                <div class="mui-col-xs-4"><?= htmlspecialchars($value['menu_name']) ?></div>
                                <div class="mui-col-xs-4">(<?= htmlspecialchars($value['menu_quant_max']) ?>&nbsp;X&nbsp;単<?= htmlspecialchars($value['menu_price']) ?>)</div>
                                <div class="mui-col-xs-4"><span class="mui-pull-right">￥<?= htmlspecialchars($value['menu_price_max']) ?></span></div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="mui-col-xs-12 border-bottom_1"> <span class="mui-pull-right"></span></div>
                    <div class="mui-col-xs-12">毎度ご利用いただき、誠にありがとうございます!<br />
                        <div class="mui-row border-bottom_1">
                        </div>
                    </div>
                    <div style="float: right;"> 別々で：
                        <font color="red">
                            <div id="price_count" style="float: right;">円／人</div>
                        </font>
                    </div>
                </div>
            </div>
        </div>
        <nav class="mui-bar mui-bar-tab " id="nav">
            <div class="s_amountto">
                <input type="hidden" value="<?= htmlspecialchars($price_count) ?>" id="price_count_hid">
                <font style="font-size: 25px;">合 计：￥<?= number_format(floor($price_count)) ?></font>
                <input type="hidden" name="pay_price" value="<?= htmlspecialchars($price_count) ?>">
                <input type="button" id="sub_btn" value="お会計する"/>
            </div>
        </nav>
        <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript">
            $('#c_count_txt').change(function() {
                //割勘人数
                var c_count = $("#c_count_txt").val();
                //警告
                if (c_count == 0) {
                    alert("0人で割勘？");
                    return false;
                }
                //合計
                var p_count = $("#price_count_hid").val();
                //四捨五入
                var result = Math.round(p_count / c_count);
                //余りを判断する
                if (p_count % c_count != 0) {
                    $("#price_count").text("平均　" + result + "円／人");
                } else {
                    $("#price_count").text(result + "円／人");
                }
            });
            //お会計
            $('#sub_btn').click(function() {
                $('form').submit();
            });
        </script>

    </form>
</body>

</html>