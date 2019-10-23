<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"E:\workspace\testshop\template\admin\member\user\list.html";i:1571817392;s:48:"E:\workspace\testshop\template\admin\layout.html";i:1571710914;}*/ ?>
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
		                <div class="layui-input-inline">
		                    <input type="text" name="keyword" placeholder="请输入关键字" autocomplete="off" class="layui-input">
		                </div>
		                <div class="layui-input-inline" style="width:40px">
		                    <button class="layui-btn layui-btn-sm" lay-submit lay-filter="form-search">
		                        <i class="fa fa-search"></i></button>
		                </div>
		                <div class="layui-input-inline" style="width:40px">
		                    <a class="layui-btn layui-btn-sm" href="">
		                        <i class="fa fa-refresh"></i>
		                    </a>
		                </div>
		            </div>
					<div class="layui-btn-group layui-layout-right">

						<?php if($rbac->check($ctrl.'/'.$action.'_export')): ?>
						<button class="layui-btn layui-btn-sm export-btn" lay-submit lay-filter="form-export">
							<i class="fa fa-upload"></i>导出
						</button>
						<?php endif; ?>
					</div>
					<div class="layui-btn-group layui-layout-right" style="display:none;">
						<?php if($rbac->check($ctrl.'/'.$action.'_upgrade')): ?>
						<button class="layui-btn layui-btn-sm batch-deal-btn" data-url="<?php echo url($ctrl.'/'.$action.'_upgrade'); ?>" data-msg="确定要将已选中的用户升为团长吗？" data-val="2">
							<i class="fa fa-rss"></i>升级
						</button>
						<?php endif; ?>
					</div>
		        </div>
		    </form>
		</div>
		<div class="layui-body" id="table-box"></div>
		<div class="layui-footer" id="page-box"></div>
	</div>
</body>
<script>
window.recall=function(){
    //监听提交
    form.on('submit(form-search)', function(data) {
        var field = data.field;
        var searchWhere = {};

        if (field.type) {
            searchWhere['a.type'] = field.type;
        }
        if (field.keyword) {
            searchWhere['a.nickname|a.mobile'] = ['like', '%' + field.keyword + '%'];
        }
        adminTable.search(searchWhere);
        return false;
    });
    form.on('submit(form-export)', function(data) {
        var field = data.field;
        var searchWhere = {};
       	searchWhere['type'] =1;

        if (field.keyword) {
            searchWhere['nickname|mobile'] = ['like', '%' + field.keyword + '%'];
        }
        tools.ajax('<?php echo url("member/user_export"); ?>',{where:searchWhere},function(res){
            var $a = $("<a>");
            $a.attr("href", res.file);
            $a.attr("download", res.filename);
            $("body").append($a);
            $a[0].click();
            $a.remove();
        })
        return false;
    });

    tools.table({
        jsonUrl: "<?php echo url($ctrl.'/'.$action.'_list'); ?>",
        getWhere:function(){
        	var wh = {'type':1};

        	return wh;
        },
        dealParam: {

            <?php if($rbac->check($ctrl.'/'.$action.'_change')): ?>
            change: {
                name: "修改",
                icon: "fa fa-edit",
                callback: function(row) {
                    tools.adminShow('修改',"<?php echo url($ctrl.'/'.$action.'_change'); ?>?id="+row.id);
                }
            }
            <?php endif; ?>
        },
        colModel: [{
            display: 'checkbox',
            name: 'id',
            width: '15px'
        }, {
            display: '头像',
            name: 'headpic',
            width: '50px',
            dealItem:function(row){
            	return '<img src="'+row.headpic+'" style="max-height: 50px;">';
            }
        }, {
            display: '昵称/手机号',
            name: 'nickname',
            dealItem:function(row){
            	return '<div class="text-wrap" style="width:150px;">'+row.nickname+'<br>'+row.phone+'</div>';
            }
        }, {
            display: '性别',
            name: 'sex',
            dealItem:function(row){
            	return row.sex == 1 ? '男' : '女';
            }
        },  {
            display: '注册时间',
            name: 'addtime'
        }, {
            display: '操作',
            icon: 'fa fa-cog',
            width: '80px',
            name: 'dealtools'
        }]
    });
}
</script>

</html>