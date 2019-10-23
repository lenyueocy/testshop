<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:60:"E:\workspace\testshop\template\admin\order\order\detail.html";i:1571716034;s:48:"E:\workspace\testshop\template\admin\layout.html";i:1571710914;}*/ ?>
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
		<form class="layui-form layui-form-pane" onsubmit="return false;">
			<div class="layui-body" style="top: 0;bottom:0;">
				<div class="layui-tab">
					<ul class="layui-tab-title">
						<li class="layui-this">基本信息</li>
						<li class="">商品信息</li>
					</ul>
					<div class="layui-tab-content">
						<div class="layui-tab-item layui-show">
							<div class="d-item-col">
			                    <div class="d-item">
			                        <div class="d-title">订单号</div>
			                        <div class="d-content"><?php echo $detail['orderno']; ?></div>
			                    </div>
			                    <div class="d-item">
			                        <div class="d-title">状态</div>
			                        <div class="d-content"><?php echo $status[$detail['status']]; if($detail['refundstate'] == 1): ?><font color="red">已退款</font><?php endif; ?>
									</div>
			                    </div>
			                </div>
			                <div class="d-item-col">
			                	<div class="d-item">
			                        <div class="d-title">订单金额</div>
			                        <div class="d-content"><?php echo $detail['orderfee']; ?></div>
			                    </div>
			                    <div class="d-item">
			                        <div class="d-title">商品数量</div>
			                        <div class="d-content"><?php echo $detail['goodsnum']; ?></div>
			                    </div>
			                </div>
			                <div class="d-item-col">
			                	<div class="d-item">
			                        <div class="d-title">姓名</div>
			                        <div class="d-content"><?php echo $detail['name']; ?></div>
			                    </div>
			                    <div class="d-item">
			                        <div class="d-title">手机号</div>
			                        <div class="d-content"><?php echo $detail['mobile']; ?></div>
			                    </div>
			                </div>
			                <div class="d-item-col">
			                    <div class="d-item d-block">
			                        <div class="d-title">用户备注</div>
			                        <div class="d-content"><?php echo $detail['mark']; ?></div>
			                    </div>
			                </div>
							<div class="d-item-col">
								<div class="d-item d-block">
									<div class="d-title">商户备注</div>
									<div class="d-content"><font color="red"><?php echo $detail['comm_mark']; ?></font></div>
								</div>
							</div>

							<div class="d-item-col">
			                    <div class="d-item d-block">
			                        <div class="d-title">地址</div>
			                        <div class="d-content"><?php echo $detail['address']; ?></div>
			                    </div>
			                </div>
			            </div>
			            <!-- 红包信息 -->
			            <div class="layui-tab-item">
			            	<?php if(is_array($guds) || $guds instanceof \think\Collection || $guds instanceof \think\Paginator): $i = 0; $__LIST__ = $guds;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
			            	<fieldset class="layui-elem-field">
							  	<legend><?php echo $vo['title']; ?></legend>
							  	<div class="layui-field-box">
				                    <div class="d-item-col">
										<div class="d-item">
											<div class="d-title">商品名称</div>
											<div class="d-content"><?php echo $vo['title']; ?></div>
										</div>
				                    	<div class="d-item">
					                        <div class="d-title">数量</div>
					                        <div class="d-content"><?php echo $vo['num']; ?></div>
					                    </div>
				                    	<div class="d-item">
					                        <div class="d-title">单价</div>
					                        <div class="d-content"><?php echo $vo['price']; ?></div>
					                    </div>
					                    <div class="d-item">
					                        <div class="d-title">总价</div>
					                        <div class="d-content"><?php echo $vo['totalprice']; ?></div>
					                    </div>
				                    </div>
			                    </div>
							</fieldset>
							<?php endforeach; endif; else: echo "" ;endif; ?>
			            </div>
					</div>
				</div>
			</div>
		</form>
	</div>
</body>

</html>