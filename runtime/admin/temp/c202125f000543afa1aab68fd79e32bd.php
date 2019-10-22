<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:53:"E:\workspace\B2C\template\admin\tools\index_list.html";i:1554195608;s:43:"E:\workspace\B2C\template\admin\layout.html";i:1554195608;}*/ ?>
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
		<div class="layui-header">
			<form class="layui-form top-search-form" action="" onsubmit="return false;">
		        <div class="layui-form-pane">
		        	<div class="layui-form-item">
		                <div class="layui-input-inline" style="width: 300px;">
							数据库表列表 (共<?php echo $tableNum; ?>张记录，共计<?php echo $total; ?>）
		                </div>

		                <div class="layui-input-inline" style="width:40px">
		                    <a class="layui-btn layui-btn-sm" href="">
		                        <i class="fa fa-refresh"></i>
		                    </a>
		                </div>
		            </div>
					<div class="layui-btn-group layui-layout-right">
						<button class="layui-btn layui-btn-sm export-btn"  id="ing_btn">
							<span><i class="fa fa-book"></i><span id="export">数据备份</span></span>
						</button>
					</div>

		        </div>
		    </form>

		</div>

		<form  method="post" id="export-form" action="<?php echo url($ctrl.'/'.$action.'_export'); ?>">
		<div class="layui-body" id="table-box">
			<table class="tablejs-table" border="0" cellspacing="0" cellpadding="0">
				<thead class="tablejs-head">
				<tr>
					<th style="width:15px">
					<input class="tablejs-check-all" type="checkbox" value="0" onclick="javascript:$('input[name*=tables]').prop('checked',this.checked);"></th>
					<th style="width:50px">数据库表</th>
					<th style="width:auto;">记录条数</th>
					<th style="width:auto;">占用空间</th>
					<th style="width:auto;">编码</th>
					<th style="width:auto;">创建时间</th>
					<th style="width:auto;">备份状态</th>
				</tr></thead><tbody class="tablejs-body">
			<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$vo): ?>
			<tr>
				<td><input type="checkbox" class="tablejs-check-item" name="tables[]" value="<?php echo $vo['Name']; ?>"></td>
				<td class=""><?php echo $vo['Name']; ?></td>
				<td class=""><?php echo $vo['Rows']; ?></td>
				<td class=""><?php echo format_bytes($vo['Data_length']); ?></td>
				<td class=""><?php echo $vo['Collation']; ?></td>
				<td class=""><?php echo $vo['Create_time']; ?></td>
				<td class=""><div style=" width: 200px;" class="info">未备份</div></td>
			</tr>
			<?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
			</table>



		</div>
		</form>
		<div class="layui-footer" id="page-box"></div>
	</div>
</body>
<script type="text/javascript" src="/admin/jquery-1.8.2.min.js"></script>
<script>


        var $form = $("#export-form"), $export = $("#export"), tables
        $export.click(function(){
            if($("input[name^='tables']:checked").length == 0){
                layer.alert('请选中要备份的数据表', {icon: 2});
                return false;
            }
            $export.addClass("disabled");
            $export.html("正在发送备份请求...");

            $.post(
                $form.attr("action"),
                $form.serialize(),
                function(data){
                    if(data.status){
                        tables = data.tables;
                        console.log(tables);
                        $export.html(data.info + "开始备份，请不要关闭本页面！");
                        backup(data.tab);
                        window.onbeforeunload = function(){ return "正在备份数据库，请不要关闭！" }
                    } else {
                        layer.alert(data.info, {icon: 2});
                        $export.removeClass("disabled");
                        $export.html("立即备份");
                    }
                },
                "json"
            );
            return false;
        });

        function backup(tab, status){
            status && showmsg(tab.id, "开始备份...(0%)");
            $.get($form.attr("action"), tab, function(data){
                if(data.status){
                    showmsg(tab.id, data.info);
                    if(!$.isPlainObject(data.tab)){
                        $export.removeClass("disabled");
                        $export.html("备份完成，点击重新备份");
                        window.onbeforeunload = function(){ return null }
                        return;
                    }
                    backup(data.tab, tab.id != data.tab.id);
                } else {
                    $export.removeClass("disabled");
                    $export.html("立即备份");
                }
            }, "json");
        }

        function showmsg(id, msg){
            console.log(tables[id] );
            $form.find("input[value=" + tables[id] + "]").closest("tr").find(".info").html(msg);
        }

</script>

</html>