<!DOCTYPE html>
<?php
session_start();
?>
<html>

<head>
	<meta charset="UTF-8">
	<title>楽々注文</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<link href="css/mui.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="css/iconfont.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="icon" href="images/icon.jpg" type="image/jpg">
	<style>
		.mui-bar-nav>.mui-pull-right {
			line-height: 300%;
			color: #007aff;
		}
	</style>
</head>

<body>
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
	</header>
	<div class="mui-content">
		<div class="mui-row integraltitle">
			<?php
			//カテゴリを取得
			include './apps/dao/get_pre_jtc_restaurant_category_m.php';
			foreach ($res as $value) {
				//カテゴリリスト
				$cates_id[] = $value['cate_id'];
				//カテゴリリスト
				$cates_name[] = $value['cate_name'];
			}
			// クエリーを閉じる
			$res = null;
			?>
			<!-- 注目カテゴリを取得する-->
			<?php
			for ($i = 0; $i < count($cates_id); $i++) {
				//1番目のカテゴリID
				$cate_id = $cates_id[0];
				//優先3件を注目エリアに表示
				if ($i > 2) {
					break;
				}
			?>
				<div class="mui-col-xs-4">
					<a href="integral.php?sid=<?= htmlspecialchars($shop_id) ?>&tid=<?= htmlspecialchars($table_id) ?>&cid=<?= htmlspecialchars($cates_id[$i]) ?>" class="">
						<i class="icon iconfont icon-xianjin"></i>
						<p><b><?= htmlspecialchars($cates_name[$i]) ?></b></p>
					</a>
				</div>
			<?php
			}
			?>

		</div>
		<!-- カテゴリ -->
		<div class="mui-row i_broadcast">
			<?php
			for ($i = 0; $i < count($cates_id); $i++) {
				if ($i > 2) {
			?>
					<div class="mui-col-xs-3"><a href="integral.php?sid=<?= htmlspecialchars($shop_id) ?>&tid=<?= htmlspecialchars($table_id) ?>&cid=<?= htmlspecialchars($cates_id[$i]) ?>"><?= htmlspecialchars($cates_name[$i]) ?></a></div>
			<?php
				}
			}
			?>
		</div>
		<!--メニュー表示-->
		<div class="mui-row integralcont">
			<?php
			$shop_id = $_GET['sid'];
			//カテゴリによりメニューを表示する
			if ($_GET['cid'] != null ||  $_GET['cid'] != "") {
				$cate_id = $_GET['cid'];
			}
			//メニュー取得
			include './apps/dao/get_pre_jtc_restaurant_menu_m_cid.php';
			foreach ($res_rm as $value2) {
			?>
				<div class="mui-col-xs-6">
					<p><b><?= htmlspecialchars($value2['menu_name']) ?></b></p>
					<p><img src="<?= htmlspecialchars($value2['filename']) ?>" />
						<font color=red>￥<span><?= $value2['menu_price'] ?></span></font>
					</p>
					<p><a href="indent.php" class="mui-pull-right"><input type="button" id="sub_btn" value="注文する"/></a></p>
				</div>
			<?php
				//$_SESSION['m_count'] = $index_id;
			}
			?>
		</div>
	</div>
	<nav class="mui-bar mui-bar-tab " id="nav">
		<a class="mui-tab-item mui-active" id="a1" href="classify.php?sid=<?= htmlspecialchars($shop_id) ?>&tid=<?= htmlspecialchars($table_id) ?>">
			<span class="mui-icon icon iconfont icon-qrcode"></span>
			<span class="mui-tab-label">トップ</span>
		</a>
		<a class="mui-tab-item" id="a2" href="indent.php">
			<span class="mui-icon icon iconfont icon-clock"></span>
			<span class="mui-tab-label">注文履歴</span>
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
	<script src="js/mui.min.js"></script>
	<script type="text/javascript">
		mui.init();
		mui('body').on('tap', 'a', function() {
			document.location.href = this.href;
		});
	</script>
</body>

</html>