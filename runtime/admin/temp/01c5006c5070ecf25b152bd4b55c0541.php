<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"E:\workspace\B2C\template\admin\goods\category\edit.html";i:1554195608;s:43:"E:\workspace\B2C\template\admin\layout.html";i:1554195608;}*/ ?>
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
		<?php echo $html->formBegin($detail['id'],$detail['sign']); ?> 
		<div class="layui-body" style="top: 0;">
			<div class="layui-tab">
				<ul class="layui-tab-title">
					<li class="layui-this">基本信息</li>
					<li>图片信息</li>
				</ul>
				<div class="layui-tab-content">
					<div class="layui-tab-item layui-show">
						<?php if(!(empty($parent) || (($parent instanceof \think\Collection || $parent instanceof \think\Paginator ) && $parent->isEmpty()))): ?>
							<?php echo $html->input([
								'label'=>'父级分类',
								'lay-verify'=>'required',
								'ext'=>'disabled',
								'name'=>'parent_node',
								'value'=>$parent['title']
							]); endif; ?>
						<?php echo $html->input([
							'label'=>'分类标题',
							'lay-verify'=>'required',
							'name'=>'title',
							'value'=>$detail['title']
						]); ?>
						<?php echo $html->input([
							'label'=>'排序',
							'lay-verify'=>'required|number',
							'name'=>'sort',
							'value'=>$detail['sort']
						]); ?>
					</div>
					<!--***********图片*************-->
					<div class="layui-tab-item">
						<?php echo $html->images([
							'field'=>'single',
							'label'=>'分类图片',
							'images'=>$detail['single']
						]); ?>
					</div>
				</div>
			</div>
		</div>
		<?php echo $html->formEnd('','sub-form'); ?>
	</div>
</body>
<script>
	window.recall = function() {
		$(".upload-img-list").on("click",'#upload-btn-single',function(){
            window.uploadConfig = {
                num : 1,
                container : "#upload-container-single",
                mark : 'single',
                chooseFunc : tools.chooseFile
            }
            tools.adminShow('分类图片',"<?php echo url('file/choose'); ?>");
        });
		form.on('submit(sub-form)', function(data) {
			tools.ajax('<?php echo url($ctrl."/".$action."_edit"); ?>',data.field,function(){
				layer.success('编辑成功');
		        setTimeout(function(){
		            tools.adminClose();
					parent.window.pageTool.refresh();
		        },1500);
			});
		});
	}
</script>

</html>