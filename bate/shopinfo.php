<!DOCTYPE html>
<?php
session_start();
?>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <title>店舗情報</title>
    <link href="css/mui.min.css" rel="stylesheet" />
    <link rel="icon" href="images/icon.jpg" type="image/jpg">
    <style>
        html {
            height: 100%
        }

        body {
            height: 100%
        }

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

        .div-line {
            height: 40px;
            line-height: 40px;
        }
    </style>

</head>
<body>
    <?php
    //URLキー項目
    $shop_id = $_SESSION['sid'];
    $table_id =  $_SESSION['tid'];
    // データベースに接続
    include './apps/dao/db_access.php';
    //ショップ情報を取得する
    include './apps/dao/get_pre_jtc_shop_m.php';
    ?>
    <header class="mui-bar mui-bar-nav header">
        <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" href="classify.php?sid=<?= htmlspecialchars($shop_id) ?>&tid=<?= htmlspecialchars($table_id) ?>"></a>
        <h1 class="mui-title"><div style="font-size:17px;font-weight: 600;"><?= htmlspecialchars($shop_nm) ?></div></h1>
    </header>
    <div class="mui-content addressform">
        <div class="div-line">
            営業時間：<?= htmlspecialchars($open_hhmm) ?>
        </div>
        <div class="div-line">
            ラストオーダー：<?= htmlspecialchars($open_memo) ?>
        </div>
        <div class="div-line">
            平均価格：<?= number_format(floor($ave_price)) ?>円
        </div>
        <div class="div-line">
            Tel：<?= htmlspecialchars($tel) ?>
        </div>
        <div class="div-line">
            住所：<?= htmlspecialchars($address) ?>
        </div>
    </div>
    <form></form>
    <div id="map"></div>
    <script type="text/javascript">
        function initMap() {
            var useragent = navigator.userAgent;
            var mapdiv = document.getElementById("map");

            if (useragent.indexOf('iPhone') != -1 || useragent.indexOf('Android') != -1) {
                mapdiv.style.width = '98%';
                mapdiv.style.height = '50%';
            }

            var opts = {
                zoom: 15,
                center: new google.maps.LatLng(<?= htmlspecialchars($lon) ?>,<?= htmlspecialchars($lat) ?>)//35.6807527, 139.7670716
            };
            var map = new google.maps.Map(mapdiv, opts);
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnPbtA3JEN13Wok1a3dH2hm-ookToYHSI&callback=initMap">
    </script>
</body>

</html>