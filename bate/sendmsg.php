<!DOCTYPE html>
<html>
<?php
session_start();
?>

<head>
	<meta charset="UTF-8">
	<title>店員呼出</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<link href="css/mui.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="icon" href="images/icon.jpg" type="image/jpg">
</head>

<body>
	<form action="msginfo.php" method="POST">
		<?php
		// 二重送信防止用トークンの発行
		$token = uniqid('', true);
		//トークンをセッション変数にセット
		$_SESSION['token_msg'] = $token;
		//URLキー項目
		$shop_id = $_SESSION['sid'];
		$table_id =  $_SESSION['tid'];
		// データベースに接続
		include './apps/dao/db_access.php';
		//ショップ情報を取得する
		include './apps/dao/get_pre_jtc_restaurant_msg_m.php';
		//メッセージ
		$_SESSION['msg_info'] = "スタッフに伝えました、少々お待ちください。";
		?>
		<header class="mui-bar mui-bar-nav s_header">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left" href="indent.php"></a>
			<h1 class="mui-title">ご用件</h1>
			<a href="#"><i class="mui-icon mui-icon-chat"></i></a>
		</header>
		<div class="mui-content">
			<a href="#">
				<input type="submit" name="defult_btn" id="defult_btn" value="店員呼出" class="mui-bottom mui-btn-block" style="background-color:#EC971F;height: 50px;margin: 10px 0;color:#FFFFFF;" />
			</a>
			<?php
			foreach ($res as $value) {
			?>
				<a href="#"><input type="submit" id="<?= htmlspecialchars($value['msg_name']) ?>" value="<?= htmlspecialchars($value['msg_name']) ?>" onclick="setMsgId('<?= htmlspecialchars($value['msg_id']) ?>')" class="mui-bottom mui-btn-block" style="background-color:pink;height: 40px;margin: 10px 0;color:black;" /></a>
			<?php
			}
			$res = null;
			?>
			<input type="hidden" id="msg_id" name="msg_id">
			<input type="hidden" name="token" value="<?php echo $token; ?>">
		</div>
		<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript">
			$('#defult_btn').click(function() {
				//var mp3 = new Audio('mp3/default.mp3'); 
				//mp3.play(); 
				$('#msg_id').val('SYS0000000');
			});
			//セットメッセージID
			function setMsgId(msgId) {
				$('#msg_id').val(msgId);
			}
		</script>
		<script type="text/javascript" src="js/browser-back.js"></script>
		<script type="text/javascript" src="js/browser-reload.js"></script>
	</form>
</body>

</html>