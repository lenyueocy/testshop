<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:51:"E:\workspace\B2C\template\admin\rbac\role\edit.html";i:1554195608;s:43:"E:\workspace\B2C\template\admin\layout.html";i:1554195608;}*/ ?>
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
		
    <link rel="stylesheet" href="/plugins/zTree/css/zTreeStyle/zTreeStyle.css?v=<?php echo rand(); ?>">
    <script type="text/javascript" src="/plugins/zTree/js/jquery.ztree.all.min.js"></script>

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
								'label'=>'角色名称',
								'lay-verify'=>'required',
								'name'=>'title',
								'value'=>$detail['title']
							]); ?>
							
							<div class="layui-form-item layui-form-text">
			                    <label class="layui-form-label">权限</label>
			                    <div class="layui-input-block ztree" id="node-tree">
			                    </div>
		                    </div>
						</div>
					</div>
				</div>
			</div>
			<?php echo $html->formEnd(url($ctrl."/".$action."_edit")); ?>
	</div>
</body>
<script>
	var treeData = <?php echo json_encode($nodes); ?>;
	var setting = {
		check: {
			enable: true,
			autoCheckTrigger: true
		},
		data: {
			simpleData: {
				enable: true
			}
		},
		callback: {
			onCheck: onCheck
		}
	};
	function onCheck(event, treeId, treeNode) {
		cancelHalf(treeNode)
		treeNode.checkedEx = true;
	}
	function onAsyncSuccess(event, treeId, treeNode, msg) {
		cancelHalf(treeNode);
	}
	function cancelHalf(treeNode) {
		if (treeNode.checkedEx) {
			return;
		}
		var zTree = $.fn.zTree.getZTreeObj("node-tree");
		treeNode.halfCheck = false;
		zTree.updateNode(treeNode);	
	}
	var beforeSubForm = function(formObj){
		var zTree = $.fn.zTree.getZTreeObj("node-tree");
		var checkedNodes = zTree.getCheckedNodes();
		var checked = [];
		for(var key in checkedNodes){
			checked.push(checkedNodes[key].id);
		}
		formObj.nodes = checked;
		console.log(formObj);
		return formObj;
	}
	window.recall=function(){
		$.fn.zTree.init($("#node-tree"), setting, treeData);
	}
</script>

</html>