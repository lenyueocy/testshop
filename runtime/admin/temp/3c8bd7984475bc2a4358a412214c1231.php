<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:47:"E:\workspace\B2C\template\admin\index\edit.html";i:1554195608;s:43:"E:\workspace\B2C\template\admin\layout.html";i:1554195608;}*/ ?>
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
		<?php echo $html->formBegin($detail['id']); ?>
		<div class="layui-body" style="top: 0;">
			<div class="layui-tab">
				<ul class="layui-tab-title">
					<li class="layui-this">基本信息</li>
				</ul>
				<div class="layui-tab-content">
					<div class="layui-tab-item layui-show">
						<?php echo $html->input([
							'label'=>'用户名', 
							'lay-verify'=>'required', 
							'name'=>'username',
							'value'=>$detail['username'] 
						]); ?> 
						<?php echo $html->input([ 
							'label'=>'昵称',
							'lay-verify'=>'required', 
							'name'=>'nickname',
							'value'=>$detail['nickname'] 
						]); ?> 
						<?php echo $html->input([
							'label'=>'密码',
							'name'=>'password',
							'lay-verify'=>'required', 
							'ext'=>'type="password"' 
						]); ?> 
						<?php echo $html->radio([
							'label'=>'性别', 
							'name'=>'sex', 
							'options'=>[1=>'男',2=>'女'],
							'value'=>$detail['sex'] 
						]); ?>
					</div>
				</div>
			</div>
		</div>
		<?php echo $html->formEnd(url('index/edit')); ?>
	</div>
</body>

</html>