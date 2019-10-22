<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:55:"E:\workspace\B2C\template\admin\system\config\list.html";i:1554195608;s:43:"E:\workspace\B2C\template\admin\layout.html";i:1554195608;s:57:"E:\workspace\B2C\template\admin\system\config\system.html";i:1554195608;s:59:"E:\workspace\B2C\template\admin\system\config\register.html";i:1554195608;}*/ ?>
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
		<div class="layui-body" style="top: 0;">
			<div class="layui-tab">
				<ul class="layui-tab-title">
					<?php if(is_array($configItem) || $configItem instanceof \think\Collection || $configItem instanceof \think\Paginator): $i = 0; $__LIST__ = $configItem;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
						<li class="<?php echo $i==1?'layui-this' : ''; ?>"><?php echo $item['title']; ?></li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<div class="layui-tab-content">
					<div class="layui-tab-item layui-show">
						<?php echo $html->formBegin(); ?>
							<?php echo $html->input([
	'label'=>'客服热线',
	'lay-verify'=>'required|number',
	'name'=>'mobile',
	'placeholder'=>'客服热线',
	'value'=>isset($configs['system']['mobile']) ? $configs['system']['mobile'] : ''
]); ?>

<?php echo $html->input([
	'label'=>'分享标题',
	'lay-verify'=>'required',
	'name'=>'shareTitle',
	'value'=>isset($configs['system']['shareTitle']) ? $configs['system']['shareTitle'] : ''
]); ?>

<?php echo $html->input([
	'label'=>'分享图片',
	'lay-verify'=>'required',
	'name'=>'shareImage',
	'placeholder'=>'点击选择图片',
	'value'=>isset($configs['system']['shareImage']) ? $configs['system']['shareImage'] : ''
]); ?>

<input type="hidden" name="sign" value="system">
						<?php echo $html->formEnd(url("system/config_list")); ?>
		            </div>

		            <!--<div class="layui-tab-item" style="">-->
						<!--<?php echo $html->formBegin(); ?>-->
							<!--<?php echo $html->input([
'label'=>'休市开始',
'lay-verify'=>'required',
'name'=>'salestart',
'placeholder'=>'请选择休市开始时间',
'value'=>isset($configs['system']['salestart']) ? $configs['system']['salestart'] : ''
]); ?>
<?php echo $html->input([
'label'=>'休市结束',
'lay-verify'=>'required',
'name'=>'saleend',
'placeholder'=>'请选择休市结束时间',
'value'=>isset($configs['system']['saleend']) ? $configs['system']['saleend'] : ''
]); ?>
<div class="layui-form-item" pane>
	<label class="layui-form-label">规则状态</label>
	<div class="layui-input-block">
		<input type="checkbox" name="isopen"  value="1" lay-skin="switch" lay-text="开启|关闭" >
	</div>
</div>

<input type="hidden" name="sign" value="system">-->
						<!--<?php echo $html->formEnd(url("system/config_list")); ?>-->
		            <!--</div>-->

				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var chooseFile = function(file,obj){
			if(file[0]){
				obj.val(file[0].key);
			}else{
                obj.val("");
			}

		};
		window.recall = function(){
			$("#layinput-shareImage").on("click",function(){
				window.uploadConfig = {
	                num : 1,
	                container : $(this),
	                mark : 'single',
	                chooseFunc : chooseFile
	            }
	            tools.adminShow('分享图片',"<?php echo url('file/choose'); ?>");
			});
            laydate.render({
                elem: '#layinput-salestart',
                type: 'datetime'
            });
            laydate.render({
                elem: '#layinput-saleend',
                type: 'datetime'
            });
		}
	</script>
</body>

</html>