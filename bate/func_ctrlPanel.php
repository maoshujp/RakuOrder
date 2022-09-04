<!DOCTYPE html>
<html>
<?php
session_start();
?>

<head>
	<meta charset="UTF-8">
	<title>コントロール パネル</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<!--リロード60秒-->
	<meta http-equiv="refresh" content="60">
	<link href="css/mui.css" rel="stylesheet" />

	<link rel="stylesheet" href="css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="icon" href="images/icon.jpg" type="image/jpg">
	<style>
		.i_menu>.mui-col-xs-3 {
			width: 23%;
		}

		.i_menu>.mui-col-xs-3 a i {
			font-size: 30px;
		}

		.mui-grid-view.mui-grid-9 .mui-table-view-cell {
			border: 1px solid #CCCCCC;
			border-radius: 5px;
			margin: 1%;
		}

		.mui-table-view.mui-grid-view .mui-table-view-cell {
			padding: 0;
		}

		.mui-grid-view.mui-grid-9 .mui-table-view-cell {
			padding: 0;
		}

		.i_menu>.col-xs-3:first-child {
			background: #007AFF;
		}

		.cp_menu>.mui-col-xs-4>a>img {
			border-radius: 15px;
			padding: 5px;
		}

		.cp_menu>.mui-col-xs-4>a>div {
			position: absolute;
			top: 10%;
			color: #FFFFFF;
			/*background: rgba(0,0,0,.2);*/
			width: 92%;
			margin-left: 5px;
			font-size: 12px;
			line-break: 2em;
		}

		.cp_menu>.mui-col-xs-4>a>div>span {
			float: right;
			color: #000000;
		}

		.cp_menu>.mui-col-xs-12 {
			color: #666666;
			line-height: 2em;
			text-indent: 5px;
		}

		.nine>.mui-col-xs-12 {
			color: #666666;
			line-height: 2em;
			text-indent: 5px;
		}

		.nine>.mui-col-xs-6 {
			background: #3399ff;
			border-radius: 5px;
			padding: 5px;
			width: 49%;
			margin-left: 0.5%;
			margin-right: 0.5%;
		}

		.nine>.mui-col-xs-6>a {
			color: #FFFFFF;
			text-align: center;
			display: block;
		}

		.nine>.mui-col-xs-6>a>span {
			font-size: 12px;
		}

		.advertisement>.mui-col-xs-12 {
			width: 98%;
			padding: 1%;
		}

		.advertisement>.mui-col-xs-12>img {
			border-radius: 5px;
		}
	</style>
</head>

<body>
	<?php
	//URLパラメータを取得する
	$shop_id = $_SESSION['sid'];
	$shop_nm = $_SESSION['shop_nm'];
	// データベースに接続
	include './apps/dao/db_access.php';
	?>
	<header class="mui-bar mui-bar-nav">
		<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" href="index.html"></a>
		<h1 class="mui-title">コントロール パネル</h1>
	</header>
	<!--ヘッダ-->
	<div class="mui-content">
		<!-- リアルメッセージエリア -->
		<iframe src="logic_showMsgTbl.php" id='hoge' frameborder=“0” scrolling="no" height="60px" width="100%"></iframe>
		<?php
		//配膳状況を取得する
		include './apps/dao/get_invoice_meisai_status.php';
		if ($menu_status2_count > 0) {
			$m_bg_color = "#ffff00;";
		}
		//レジ状況を取得する
		include './apps/dao/get_invoice_status.php';
		if ($invoice_status8_count > 0) {
			$l_bg_color = "#ffff00;";
		}
		//メッセージ状況を取得する
		include './apps/dao/get_msg_status.php';
		if ($msg_status0_count > 0) {
			$ms_bg_color = "#ffff00;";
		}
		?>
		<ul class="mui-table-view mui-grid-view mui-grid-9 i_menu">
			<li class="mui-table-view-cell mui-media mui-col-xs-3">
				<a href="signin.html">
					<i class="icon iconfont icon-qiandao-copy"></i>
					<div class="mui-media-body">テーブル</div>
				</a>
			</li>
			<li class="mui-table-view-cell mui-media mui-col-xs-3" style="background:<?= htmlspecialchars($m_bg_color) ?>">
				<a href="dray.html">
					<i class="icon iconfont icon-xingyundazhuanpan"></i>
					<div class="mui-media-body">配膳</div>
				</a>
			</li>
			<li class="mui-table-view-cell mui-media mui-col-xs-3" style="background:<?= htmlspecialchars($l_bg_color) ?>">
				<a href="game.html">
					<i class="icon iconfont icon-xianjin"></i>
					<div class="mui-media-body">レジ</div>
				</a>
			</li>
			<li class="mui-table-view-cell mui-media mui-col-xs-3" style="background:<?= htmlspecialchars($ms_bg_color) ?>">
				<a href="integral.html">
					<i class="icon iconfont icon-warning"></i>
					<div class="mui-media-body">メッセージ</div>
				</a>
			</li>
		</ul>
		<!--店内状況-->
		<div class="mui-row nine">
			<div class="mui-col-xs-12"><b>ご案内</b></div>
			<?php
			//テーブル状況を取得する
			include './apps/dao/get_pre_jtc_restaurant_table_m.php';
			$t_color = "#2C7CFF"; //空き：#2C7CFF 食事中：#a0522d 片付け：#9966FF
			$t_status = "";
			foreach ($res as $value) {
				if ($value['status'] == "" || $value['status'] == "0") {
					$t_color = "#2C7CFF";
					$t_status = "空き";
				} elseif ($value['status'] == "1") {
					$t_color = "#a0522d";
					$t_status = "食事中";
				} elseif ($value['status'] == "2") {
					$t_color = "#9966FF";
					$t_status = "片付け";
				} elseif ($value['status'] == "Y") {
					$t_color = "#009900";
					$t_status = "予約済み";
				}
			?>
				<div class="mui-col-xs-6" style="background: <?= htmlspecialchars($t_color) ?>;margin-top:5px; ">
					<a href=""><?= htmlspecialchars($value['table_id']) ?>号卓 </br><span><?= htmlspecialchars($value['sit_count']) ?>人席　<?= htmlspecialchars($t_status) ?></span></a>
				</div>
			<?php
			}
			// クエリーを閉じる
			$res = null;
			?>
		</div>
		<!--料理出来上がりエリア-->

	</div>
	<!--ヘッダ-->

	<nav class="mui-bar mui-bar-tab " id="nav">
		<a class="mui-tab-item mui-active" id="a1" href="index.html">
			<span class="mui-icon icon iconfont icon-qrcode"></span>
			<span class="mui-tab-label">首页</span>
		</a>
		<a class="mui-tab-item " id="a2" href="">
			<span class="mui-icon icon iconfont icon-map"></span>
			<span class="mui-tab-label">附近</span>
		</a>
		<a class="mui-tab-item " id="a3" href="indent.html">
			<span class="mui-icon icon iconfont icon-order"></span>
			<span class="mui-tab-label">订单</span>
		</a>
		<a class="mui-tab-item " id="a3" href="my.html">
			<span class="mui-icon icon iconfont icon-account"></span>
			<span class="mui-tab-label">我的</span>
		</a>
	</nav>
	<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" charset="utf-8">
		window.onload = function() {
			setInterval("document.getElementById('hoge').src='logic_showMsgTbl.php'", 5000);
			//5秒毎に呼び出す
		}
	</script>
</body>

</html>