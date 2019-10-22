<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:52:"E:\workspace\B2C\template\admin\rbac\admin\list.html";i:1554195608;s:43:"E:\workspace\B2C\template\admin\layout.html";i:1554195608;}*/ ?>
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
						<?php if($rbac->check($ctrl.'/'.$action.'_add')): ?>
						<button class="layui-btn layui-btn-sm win-open" data-url="<?php echo url($ctrl.'/'.$action.'_add'); ?>">
							<i class="fa fa-plus-circle"></i>添加
						</button>
						<?php endif; if($rbac->check($ctrl.'/'.$action.'_del')): ?>
						<button class="layui-btn layui-btn-sm layui-bg-red" id="batch-delete" data-url="<?php echo url($ctrl.'/'.$action.'_del'); ?>" data-title="用户">
							<i class="fa fa-trash-o"></i>删除
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
var listConfig = tableList = {};
window.recall=function(){
    //监听提交
    form.on('submit(form-search)', function(data) {
        var field = data.field;
        var where = {};//tableList.config.getWhere();
        if (field.start) {
            where['a.addtime'] = ['>=', field.start];
        }
        if (field.end) {
            where['a.addtime'] = ['<=', field.end];
        }

        if (field.start && field.end) {
            where['a.addtime'] = ['between', [field.start, field.end]];
        }
        if (field.keyword) {
            where['a.username|a.nickname'] = ['like', '%' + field.keyword + '%'];
        }
        adminTable.search(where);
        /*tableList.config.where = where;
        tableList.search();*/
        return false;
    });
    
    
    tools.table({
        jsonUrl: "<?php echo url($ctrl.'/'.$action.'_list'); ?>",
        dealParam: {
        	<?php if($rbac->check($ctrl.'/'.$action.'_edit')): ?>
        	edit: {
                name: "编辑",
                icon: "fa fa-pencil-square",
                callback: function(row) {
                    tools.adminShow('编辑用户',"<?php echo url($ctrl.'/'.$action.'_edit'); ?>?id=" + row.id);
                }
            },
            <?php endif; if($rbac->check($ctrl.'/'.$action.'_del')): ?>
            del:{
            	name: "删除",
                icon: "fa fa-trash-o",
                callback: function(row) {
                	tools.delItem("<?php echo url($ctrl.'/'.$action.'_del'); ?>",[row.id],'用户');
                }
            }
            <?php endif; ?>
        },
        colModel: [{
            display: 'checkbox',
            name: 'id',
            width: '15px'
        }, {
            display: '用户名',
            name: 'username',
        }, {
            display: '昵称',
            name: 'nickname',
        }, {
            display: '角色',
            name: 'rolename',
            dealItem:function(row){
                if(row.roleid == 0){
                    return '超级管理员';
                }
                if(!row.rolename){
                    return '暂无';
                }
                return row.rolename;
            }
        },/*{
            display: '绑定团长',
            name: 'groupnickname',
            dealItem:function(row){
                if(!row.grouprealname){
                    return '暂无';
                }
                return row.groupnickname+' / '+row.grouprealname;
            }
        }, */{
            display: '性别',
            name: 'sex',
            dealItem:function(row){
            	return row.sex == 1 ? '男' : '女';
            }
        }, {
            display: '最后登录时间',
            name: 'lastlogin',
        }, {
            display: '操作',
            name: 'dealtools',
        }, ]
    });
}
</script>

</html>