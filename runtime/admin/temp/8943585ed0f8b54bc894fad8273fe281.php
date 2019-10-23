<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"E:\workspace\testshop\template\admin\base.html";i:1571710914;s:48:"E:\workspace\testshop\template\admin\layout.html";i:1571710914;}*/ ?>
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
	<div class="layui-layout layui-layout-admin">
		<div class="layui-header my-defined-haader" style="height: 45px;">
			<a id="go-main" data-url="<?php echo url('index/main'); ?>" class="layui-logo"
				href="javascript:void(0);" style="line-height: 45px;width:151px;white-space: nowrap"><?php echo $siteTitle; ?></a>
			<ul class="layui-nav layui-layout-right">
				<li class="layui-nav-item" style="line-height: 45px;"><a
					href="javascript:;"><?php echo session('admin-nickname'); ?></a>
					<dl class="layui-nav-child" style="top: 45px;">
						<dd>
							<a href="javascript:void(0);" class="win-open"
								data-url="<?php echo url('index/edit'); ?>">基本资料</a>
						</dd>
						<dd>
							<a href="<?php echo url('index/logout'); ?>">退出登录</a>
						</dd>
					</dl>
				</li>
			</ul>
		</div>
		<div class="layui-side"
			style="background-color: #FFFFFF; border-right: solid 1px #ccc; width: 150px; top: 45px;">
			<div class="layui-side-scroll" style="width: 100%;">
				<?php echo $rbac->menu(); ?>
			</div>
		</div>
		<div class="layui-body" style="bottom: 0; overflow: hidden; left: 150px; top: 45px;">
			<iframe
				src="<?php echo cookie('admin-url') ? cookie('admin-url') :  url('index/main'); ?>"
				style="border: none; overflow: hidden;" width="100%" height="100%"
				id="main-iframe"> </iframe>
		</div>
	</div>
</body>

</html>