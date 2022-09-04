<!DOCTYPE html>
<?php
session_start();
?>
<html>

<head>
    <meta charset="utf-8">
    <title>楽々注文</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!--mui.css-->
    <link rel="stylesheet" href="css/mui.min.css">
    <link rel="stylesheet" type="text/css" href="css/iconfont.css" />
    <link rel="icon" href="images/icon.jpg" type="image/jpg">
    <!--App css-->

    <style>
        * {
            font-size: 14px;
        }

        .mui-row.mui-fullscreen>[class*="mui-col-"] {
            height: 100%;
        }

        .mui-col-xs-3,
        .mui-control-content {
            overflow-y: auto;
            /*height: 100%;*/
        }

        .mui-segmented-control .mui-control-item {
            line-height: 50px;
            width: 100%;
        }

        .mui-segmented-control.mui-segmented-control-inverted .mui-control-item.mui-active {
            background-color: #fff;
        }

        /*カテゴリ開始*/

        .mui-table-view.mui-grid-view .mui-table-view-cell .mui-media-body {
            height: 100%;
        }

        .mui-table-view.mui-grid-view .mui-table-view-cell .mui-media-body img {
            width: 50%;
            float: left;
            padding: 1%;
        }

        .mui-table-view.mui-grid-view .mui-table-view-cell .mui-media-body p {
            text-align: left;
            display: block;
            color: #5a5a5a;
            font-size: 15px;
            line-height: 2em;
        }

        .mui-table-view.mui-grid-view .mui-table-view-cell .mui-media-body button {
            position: absolute;
            right: 0;
            bottom: 10%;
        }

        .mui-grid-view.mui-grid-9 .mui-table-view-cell {
            padding: 0;
        }

        .mui-grid-view.mui-grid-9 .mui-table-view-cell {
            /*background: #007AFF;*/
        }

        .mui-grid-view.mui-grid-9 .mui-table-view-cell>a:not(.mui-btn) {
            padding: 0;
        }

        .mui-grid-view.mui-grid-9 .mui-table-view-cell>a:not(.mui-btn) {
            border: none;
        }

        .mui-grid-view.mui-grid-9 {
            border: none;
        }

        .mui-table-view.mui-grid-view .mui-table-view-cell .mui-media-body {
            margin: 0;
        }

        .mui-grid-view.mui-grid-9 {
            background: #FFFFFF;
        }

        .mui-grid-view.mui-grid-9 .mui-table-view-cell {
            border: none;
        }

        .mui-table-view-cell>a {
            line-height: 3em;
            font-size: 1em;
            display: block;
        }

        .mui-table-view-cell>ul li a div p {
            line-height: 1.8em;
            font-size: 0.8em;
        }

        .mui-bar-nav>.mui-pull-right {
            line-height: 300%;
            color: #007aff;
        }

        .postion_absolute {
            position: relative;
        }

        .add {
            position: absolute;
            bottom: 0;
            right: 0;
            z-index: 999;
        }

        .add button {
            border-radius: 50%;
        }

        .amountto {
            width: 100%;
            background: #CCCCCC;
            position: relative;
            line-height: 50px;
        }

        .amountto i {
            margin-left: 5%;
            font-size: 24px;
            background: #d23c3b;
            border-radius: 50%;
            padding: 2%;
            color: #FFFFFF;
        }

        .amountto input[type="button"] {
            position: absolute;
            top: 0%;
            right: 0;
            border: none;
            border-radius: 0px;
            line-height: 42px;
            background: #d23c3b;
            color: #FFFFFF;
        }

        /**/
        .mui-numbox .mui-numbox-btn-minus {
            border-top-left-radius: 0px;
            border-bottom-left-radius: 0px;
            left: 0;
        }

        .mui-numbox [class*=btn-numbox],
        .mui-numbox [class*=numbox-btn] {
            width: 33px;
            height: 33px;
            color: #FFFFFF;
            background: #F57C2B;
            border-radius: 50%;
        }

        .mui-numbox .mui-input-numbox,
        .mui-numbox .mui-numbox-input {
            border-right: none;
            border-left: none;
        }

        .mui-numbox {
            padding: 0;
            border: none;
            border-radius: none;
            background: none;
            width: 100px;
        }

        .mui-numbox .mui-numbox-input {
            border-left: none !important;
            border-right: none !important;
        }

        /*ボタン*/
    </style>
</head>

<body>
    <form action="indent.php" method="POST">
        <header class="mui-bar mui-bar-nav">
            <?php
            //URLパラメータを取得する
            $shop_id = $_GET['sid'];
            $table_id = $_GET['tid'];
            $_SESSION['sid'] = $shop_id;
            $_SESSION['tid'] = $table_id;
            // データベースに接続
            include './apps/dao/db_access.php';
            //ショップ情報を取得する
            include './apps/dao/get_shop_name.php';
            $_SESSION['shop_nm'] = $shop_nm;
            // 二重送信防止用トークンの発行
            $token = uniqid('', true);
            //トークンをセッション変数にセット
            $_SESSION['token'] = $token;
            ?>
            <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" href="#"></a>
            <h1 class="mui-title"><?= htmlspecialchars($shop_nm) ?></h1>
            <a class="mui-pull-right" href="shopinfo.php">
                <div style="font-size:17px;">詳細</div>
            </a>
            <!--<div></div>-->
        </header>
        <div class="mui-content mui-row mui-fullscreen">
            <div class="mui-col-xs-3">
                <div id="segmentedControls" class="mui-segmented-control mui-segmented-control-inverted mui-segmented-control-vertical">
                    <?php
                    // データベースに接続
                    //include './apps/dao/db_access.php';
                    //カテゴリを取得
                    include './apps/dao/get_pre_jtc_restaurant_category_m.php';
                    foreach ($res as $value) {
                        //カテゴリリスト
                        $cates[] = $value['cate_id'];
                    ?>
                        <a class="mui-control-item" href="#content<?= htmlspecialchars($value['cate_id']) ?>"><?= htmlspecialchars($value['cate_name']) ?></a>
                    <?php
                    }
                    // クエリーを閉じる
                    $res = null;
                    ?>
                </div>
            </div>
            <div id="segmentedControlContents" class="mui-col-xs-9" style="border-left: 1px solid #c8c7cc;">
                <?php
                //データ集
                $index_id = 0;
                //カテゴリ毎に、メニューを表示する start
                // データベースに接続
                //include './apps/dao/db_access.php';
                foreach ($cates as $cate_id) {
                    $shop_id = $_GET['sid'];
                    include './apps/dao/get_pre_jtc_restaurant_menu_m_cid.php';
                ?>
                    <div id="content<?= htmlspecialchars($cate_id) ?>" class="mui-control-content">
                        <ul class="mui-table-view">
                            <li class="mui-table-view-cell">
                                <ul class="mui-table-view mui-grid-view mui-grid-9">
                                    <?php
                                    foreach ($res_rm as $value2) {
                                        $index_id = $index_id + 1;
                                    ?>
                                        <li class="mui-table-view-cell mui-media mui-col-xs-12">
                                            <div class="mui-media-body postion_absolute"><img src="<?= htmlspecialchars($value2['filename']) ?>" />
                                                <p><?= htmlspecialchars($value2['menu_name']) ?></p>
                                                <p>
                                                    <font color=red>￥<?= htmlspecialchars($value2['menu_price']) ?></font>
                                                </p>
                                                <div class="mui-numbox add">
                                                    <!-- -------キー項目------- -->
                                                    <!-- カテゴリID -->
                                                    <input type="hidden" name="cate_id_<?= $index_id ?>" value="<?= $cate_id ?>" />
                                                    <!-- メニューID -->
                                                    <input type="hidden" name="menu_id_<?= $index_id ?>" value="<?= $value2['menu_id'] ?>" />
                                                    <!-- 値段 -->
                                                    <input type="hidden" name="menu_price_<?= $index_id ?>" value="<?= $value2['menu_price'] ?>" />
                                                    <!-- "-"マイナスボタン -->
                                                    <button class=" mui-numbox-btn-minus" type="button">-</button>
                                                    <input class="mui-numbox-input" type="number" name="menu_quant_<?= $index_id ?>" id="menu_quant_<?= $index_id ?>" maxlength="1" onchange="setMinValue('menu_quant_<?= $index_id ?>')" />
                                                    <!-- "+"プラスボタン -->
                                                    <button class="mui-btn mui-numbox-btn-plus" type="button">+</button>
                                                </div>
                                            </div>
                                            <hr style="height:1px;border:none;border-top:1px dashed #0066CC;" />
                                        </li>
                                    <?php
                                        $_SESSION['m_count'] = $index_id;
                                    }
                                    ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <?php
                }
                //カテゴリ毎に、メニューを表示する  end
                // クエリを閉じる
                $res_rm = null;
                //接続を閉じる
                $pdo = null;
                ?>
                <div id="item1" class="mui-control-content mui-active">
                </div>
                <p>
                <div style="height: 50px;">
                </div>
                </p>
            </div>
        </div>
        <nav class="mui-bar mui-bar-tab " id="nav">
            <div class="amountto"><a href="indent.php"><i class="icon iconfont icon-category"></i></a>
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <input type="button" id="sub_btn" value="ご注文する" />
            </div>
        </nav>
        <script src="js/mui.min.js"></script>
        <script>
            mui.init({
                swipeBack: true //
            });
            var controls = document.getElementById("segmentedControls");
            var contents = document.getElementById("segmentedControlContents");
            var html = [];
            var i = 1,
                j = 1,
                m = 16, //
                n = 21; //
            for (; i < m; i++) {
                html.push('<a class="mui-control-item" href="#content' + i + '">选项' + i + '</a>');
            }
            //			controls.innerHTML = html.join('');
            html = [];
            for (i = 1; i < m; i++) {
                html.push('<div id="content' + i + '" class="mui-control-content"><ul class="mui-table-view">');
                for (j = 1; j < n; j++) {
                    html.push('<li class="mui-table-view-cell">第' + i + '个选项卡子项-' + j + '<>');
                }
                html.push('</ul></div>');
            }
            //			contents.innerHTML = html.join('');
            //カート1
            controls.querySelector('.mui-control-item').classList.add('mui-active');
            contents.querySelector('.mui-control-content').classList.add('mui-active');
            mui.init();
            mui('body').on('tap', 'a', function() {
                document.location.href = this.href;
            });
        </script>
        <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
        <script>
            var btn = document.getElementById('sub_btn');
            btn.addEventListener('click', function() {
                //submit()でフォームの内容を送信
                document.forms[0].submit();
            })
        </script>
        <script type="text/javascript">
            //数量が<0の場合、0でセットする
            function setMinValue(obj_name) {
                var q_txt = document.getElementById(obj_name);
                if (q_txt.value < 0) {
                    q_txt.value = 0;
                }
            }
        </script>
        <script type="text/javascript" src="js/browser-back.js"></script>
        <script type="text/javascript" src="js/browser-reload.js"></script>
    </form>
</body>

</html>