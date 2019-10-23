<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"E:\workspace\testshop\template\admin\rbac\node\edit.html";i:1571710914;s:48:"E:\workspace\testshop\template\admin\layout.html";i:1571710914;}*/ ?>
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
							<?php if(!(empty($parent) || (($parent instanceof \think\Collection || $parent instanceof \think\Paginator ) && $parent->isEmpty()))): ?>
								<?php echo $html->input([
									'label'=>'父节点',
									'lay-verify'=>'required',
									'ext'=>'disabled',
									'name'=>'parent_node',
									'value'=>$parent['title']
								]); endif; ?>
							
							<?php echo $html->input([
								'label'=>'节点标题',
								'lay-verify'=>'required',
								'name'=>'title',
								'value'=>$detail['title']
							]); if(!(empty($parent) || (($parent instanceof \think\Collection || $parent instanceof \think\Paginator ) && $parent->isEmpty()))): ?>
							    <?php echo $html->select([
							        'name'=>'controller',
							        'lay-verify'=>'required',
							        'label'=>'节点控制器',
							        'options'=>$ctrls,
							        'value'=>$detail['controller']
							    ],1,1); ?>
							    <?php echo $html->select([
							        'name'=>'action',
							        'lay-verify'=>'required',
							        'label'=>'节点操作',
							        'options'=>$classAction[$detail['controller']],
							        'value'=>$detail['action']
							    ],1,1); endif; ?>
						    
							<?php echo $html->input([
								'label'=>'排序',
								'lay-verify'=>'required|number',
								'name'=>'sort',
								'value'=>$detail['sort']
							]); ?>
						</div>
					</div>
				</div>
			</div>
			<?php echo $html->formEnd(url($ctrl."/".$action."_edit"),'sub-form'); ?>
	</div>
</body>
<script>
	var classAction = <?php echo json_encode($classAction); ?>;
	window.recall = function() {
		form.on('select(controller)', function(data) {
			var actions = [];
			if(classAction[data.value]){
				actions = classAction[data.value];
			}
			var html = '<option value="">请选择节点操作</option>';
			$.map(actions, function(item, index) {
				html += '<option value="'+item+'">' + item + '</option>';
			});
			$("#layinput-action").html(html);
			form.render('select');
		});
		form.on('submit(sub-form)', function(data) {
			tools.ajax('<?php echo url($ctrl."/".$action."_edit"); ?>',data.field,function(){
				layer.success('修改成功');
		        setTimeout(function(){
		            tools.adminClose();
					parent.window.pageTool.refresh();
		        },1500);
			});
		});
	}
</script>

</html>