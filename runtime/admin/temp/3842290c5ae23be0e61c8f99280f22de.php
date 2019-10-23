<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"E:\workspace\testshop\template\admin\member\user\change.html";i:1571821263;s:48:"E:\workspace\testshop\template\admin\layout.html";i:1571710914;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $siteTitle; ?></title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<link rel="stylesheet" href="/plugins/layui/css/layui.css?v=<?php echo PROJECT_VERSION; ?>">
		<link rel="stylesheet" href="/admin/admin.css?v=<?php echo PROJECT_VERSION; ?>" media="all">
		<script src="/plugins/layui/layui.js?v=<?php echo PROJECT_VERSION; ?>" charset="utf-8"></script>
		<script src="/admin/admin.js?v=<?php echo PROJECT_VERSION; ?>" charset="utf-8"></script>
		<script src="/plugins/tablejs/tablejs.min.js?v=<?php echo PROJECT_VERSION; ?>" charset="utf-8"></script>

		<link href="/plugins/font-awesome/css/font-awesome.min.css?v=<?php echo PROJECT_VERSION; ?>" rel="stylesheet">
		
	</head>
	
<body class="layui-layout-body">
	<div class="layui-layout layui-layout-admin my-layout-admin">
		<?php echo $html->formBegin($user['id']); ?>
			<div class="layui-body" style="top: 0;">
				<div class="layui-tab">
					<ul class="layui-tab-title">
						<li class="layui-this">基本信息</li>
					</ul>
					<div class="layui-tab-content">
						<div class="layui-tab-item layui-show">
							<?php echo $html->input([
							'label'=>'昵称',
							'lay-verify'=>'required|title',
							'name'=>'nickname',
							'value'=>$user['nickname']
							]); ?>

							<?php echo $html->input([
							'label'=>'手机号',
							'lay-verify'=>'required|phone',
							'name'=>'mobile',
							'value'=>$user['mobile']
							]); ?>

			            	<div class="d-item-col">

			                    <div class="d-item">
			                        <div class="d-title">性别</div>
			                        <div class="d-content"><?php echo $user['sex']==1?'男' : '女'; ?></div>
			                    </div>
			                    <div class="d-item">
			                        <div class="d-title">头像</div>
			                        <div class="d-content">
			                        	<div class="d-image" style="height:50px;width:50px;">
			                                <img src="<?php echo $user['headpic']; ?>">
			                            </div>
		                            </div>
			                    </div>
			                </div>
			            </div>
					</div>
				</div>
			</div>
		<?php echo $html->formEnd(url($ctrl."/".$action."_change")); ?>
	</div>
</body>

</html>