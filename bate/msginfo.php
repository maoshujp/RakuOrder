<!DOCTYPE html>
<html>
<?php
session_start();
?>

<head>
	<meta charset="UTF-8">
	<title>メッセージ</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<link href="css/mui.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/iconfont.css" />
	<link rel="icon" href="images/icon.jpg" type="image/jpg">
</head>

<body>
	<form>
		<?php
		//登録フラグ
		$insert_flg = "0"; //0:正常 1:不正
		// POSTされたトークンを取得
		$token = isset($_POST["token"]) ? $_POST["token"] : "";
		// セッション変数のトークンを取得
		$session_token = isset($_SESSION["token_msg"]) ? $_SESSION["token_msg"] : "";
		// セッション変数のトークンを削除
		unset($_SESSION["token_msg"]);
		// POSTされたトークンとセッション変数のトークンの比較
		if ($token != "" && $token == $session_token) {
			// 正常に登録画面送信データの登録を行う

		} else {
			$insert_flg = "1";
		}

		//メッセージを書込み
		$invoice_id = $_SESSION['iid'];
		$shop_id = $_SESSION['sid'];
		$table_id =  $_SESSION['tid'];

		//システム日付
		include './apps/com/com_system_date.php';

		// データベースに接続
		include './apps/dao/db_access.php';

		//明細ID情報を取得する
		include './apps/dao/get_msg_meisai_id.php';

		$meisai_id = $meisai_id + 1;
		$msg_id = $_POST["msg_id"];
		$msg_memo = "未使用";
		$status = "0"; //応答待ち
		$description = "Send by Custom at:" . $today;

		$create_user = "Custom";
		$create_date = $today;
		$create_program_id = "msginfo";

		$update_user = "Custom";
		$update_date = $today;
		$update_program_id = "msginfo";

		if ($insert_flg == "0") {
			//メッセージを書込み
			include './apps/dao/set_pre_jtc_restaurant_msg_t.php';
		}

		//メッセージ表示
		$msg_info = $_SESSION['msg_info'];
		?>

		<header class="mui-bar mui-bar-nav s_header">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" href="indent.php"></a>
			<h1 class="mui-title">メッセージ</h1>
			<a href="#"><i class="mui-icon mui-icon-chat"></i></a>
		</header>
		<!--header-->
		<div class="mui-content shopping">
			<div class="mui-row">
				<?= htmlspecialchars($msg_info) ?>
			</div>
		</div>
		<nav class="mui-bar mui-bar-tab " id="nav">
			<a class="mui-tab-item " id="a1" href="classify.php?sid=<?= htmlspecialchars($shop_id) ?>&tid=<?= htmlspecialchars($table_id) ?>">
				<span class="mui-icon icon iconfont icon-diancan"></span>
				<span class="mui-tab-label">追加注文</span>
			</a>
			<a class="mui-tab-item" id="a2" href="indent.php">
				<span class="mui-icon icon iconfont icon-viewlist"></span>
				<span class="mui-tab-label">注文履歴</span>
			</a>
			<a class="mui-tab-item " id="a3" href="shopping.php">
				<span class="mui-icon icon iconfont icon-order"></span>
				<span class="mui-tab-label">お会計</span>
			</a>
			<a class="mui-tab-item  mui-active" id="a3" href="sendmsg.php">
				<span class="mui-icon icon iconfont icon-kefu"></span>
				<span class="mui-tab-label">店員呼出</span>
			</a>
		</nav>
		<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="js/browser-back.js"></script>
		<script type="text/javascript" src="js/browser-reload.js"></script>
	</form>
</body>

</html>