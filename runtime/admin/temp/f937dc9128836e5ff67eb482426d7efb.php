<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:55:"E:\workspace\B2C\template\admin\tools\restore_list.html";i:1554195608;s:43:"E:\workspace\B2C\template\admin\layout.html";i:1554195608;}*/ ?>
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
	
<style>
	a.btn {
		font-size: 12px;
		font-weight: normal;
		line-height: 20px;
		color: #777;
		background: #FFF none;
		vertical-align: top;
		letter-spacing: normal;
		display: inline-block;
		*display: inline;
		*zoom: 1;
		height: 20px;
		padding: 1px 6px;
		margin: 0 5px 0 0;
		border: solid 1px #F5F5F5;
		border-radius: 4px;
		cursor: pointer !important;
	}
	 a.blue:hover {
		color: #555;
		background-color: rgba(53,152,220,0.8);
		border-color: rgba(53,152,220,0.8);
	}
	a.green:hover {
		color: #555;
		background-color: #1BBC9D;
		border-color: #16A086;
	}

	a.red:hover {
		color: #555;
		background-color: red;
		border-color: red;
	}
 	a.btn:hover {
		color: #555;
		text-decoration: none;
		box-shadow: 2px 2px 0 rgba(0,0,0,0.1);
	}

</style>
<body class="layui-layout-body">
	<div class="layui-layout layui-layout-admin my-layout-admin">
		<div class="layui-header">
			<form class="layui-form top-search-form" action="" onsubmit="return false;">
		        <div class="layui-form-pane">
		        	<div class="layui-form-item">
		                <div class="layui-input-inline" style="width: 400px;">
							sql文件列表(备份文件数量：<?php echo $filenum; ?>，占空间大小：<?php echo format_bytes($total); ?>)
		                </div>

		                <div class="layui-input-inline" style="width:40px">
		                    <a class="layui-btn layui-btn-sm" href="">
		                        <i class="fa fa-refresh"></i>
		                    </a>
		                </div>
		            </div>


		        </div>
		    </form>

		</div>

		<form  method="post" id="export-form" action="<?php echo url($ctrl.'/'.$action.'_export'); ?>">
		<div class="layui-body" id="table-box">
			<table class="tablejs-table" border="0" cellspacing="0" cellpadding="0">
				<thead class="tablejs-head">
				<tr>

					<th style="width:180px">文件名称</th>
					<th style="width:auto;">卷号</th>
					<th style="width:auto;">压缩</th>
					<th style="width:auto;">数据大小</th>
					<th style="width:auto;">备份时间</th>
					<th style="width:180px;">操作</th>
				</tr></thead><tbody class="tablejs-body">
			<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$vo): ?>
			<tr>

				<td class=""><?php echo $vo['basename']; ?></td>
				<td class=""><?php echo $vo['part']; ?></td>
				<td class=""><?php echo $vo['compress']; ?></td>
				<td class=""><?php echo format_bytes($vo['size']); ?></td>
				<td class=""><?php echo date("Y-m-d H:i:s",$vo['time']); ?></td>
				<td class="">
					<!--  tools.adminShow('修改用户团长',"<?php echo url($ctrl.'/'.$action.'_change'); ?>?id="+row.id);-->
					<div style=" width: 170px; max-width:170px;">
						<!--<a target="_blank" href="<?php echo url('import?time='.$vo['time']); ?>" class="btn blue db-import"><i class="fa fa-repeat"></i>恢复</a>-->
						<a href="<?php echo url('Tools/downFile',array('time'=>$vo['time'])); ?>" class="btn green"><i class="fa fa-download"></i>下载</a>
						<!--<a class="btn red" href="<?php echo url('del?time='.$vo['time']); ?>"><i class="fa fa-trash"></i>删除</a>-->
					</div>
				</td>
			</tr>
			<?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
			</table>



		</div>
		</form>
		<div class="layui-footer" id="page-box"></div>
	</div>
</body>


</html>