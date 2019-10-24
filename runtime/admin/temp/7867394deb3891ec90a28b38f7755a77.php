<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"D:\workspace\testshop\template\admin\goods\goods\list.html";i:1571823436;s:48:"D:\workspace\testshop\template\admin\layout.html";i:1571823436;}*/ ?>
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
		<script src="/admin/moment.js?v=<?php echo PROJECT_VERSION; ?>" charset="utf-8"></script>

		<link href="/plugins/font-awesome/css/font-awesome.min.css?v=<?php echo PROJECT_VERSION; ?>" rel="stylesheet">
		
	</head>
	
<body class="layui-layout-body">
	<div class="layui-layout layui-layout-admin my-layout-admin">
		<div class="layui-header">
			<form class="layui-form top-search-form" action="" onsubmit="return false;">
		        <div class="layui-form-pane">
                    <div class="layui-form-item">商品列表</div>
					<div class="layui-btn-group layui-layout-right">
						<?php if($rbac->check($ctrl.'/'.$action.'_add')): ?>
						<button class="layui-btn layui-btn-sm win-open" data-url="<?php echo url($ctrl.'/'.$action.'_add'); ?>">
							<i class="fa fa-plus-circle"></i>添加
						</button>
						<?php endif; if($rbac->check($ctrl.'/'.$action.'_deal')): ?>
						<button class="layui-btn layui-btn-sm layui-btn-danger batch-deal-btn" data-url="<?php echo url($ctrl.'/'.$action.'_deal'); ?>" data-msg="确定要下架已选中的商品吗？" data-val="1">
							<i class="fa fa-power-off"></i>下架
						</button>
						<button class="layui-btn layui-btn-sm batch-deal-btn" data-url="<?php echo url($ctrl.'/'.$action.'_deal'); ?>" data-msg="确定要上架已选中的商品吗？" data-val="2">
							<i class="fa fa-rss"></i>上架
						</button>
						<?php endif; if($rbac->check($ctrl.'/'.$action.'_del')): ?>
						<button class="layui-btn layui-btn-sm layui-bg-red" id="batch-delete" data-url="<?php echo url($ctrl.'/'.$action.'_del'); ?>" data-msg="商品">
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
window.recall = function(){
    //监听提交
    /*form.on('submit(form-search)', function(data) {
        var field = data.field;
        var searchWhere = {};
        if (field.categoryid>0) {
            searchWhere['a.cate_id'] = field.cate_id;
        }
        if (field.keyword) {
        	searchWhere['a.goodsno|a.goods_name'] = ['like', '%' + field.keyword + '%'];
        }
        adminTable.search(searchWhere);
        return false;
        
        var where = tableList.config.getWhere();

        if(field.category){
        	where['a.id'] = ['in',field.category];
        }
        
        if (field.keyword) {
            where['a.goodsno|a.title'] = ['like', '%' + field.keyword + '%'];
        }
        tableList.config.where = where;
        tableList.search();
        return false;
    });*/
    
    tools.table({
        jsonUrl: "<?php echo url($ctrl.'/'.$action.'_list'); ?>",
        dealParam: {
        	<?php if($rbac->check($ctrl.'/'.$action.'_edit')): ?>
        	edit: {
                name: "编辑",
                icon: "fa fa-pencil-square",
                callback: function(row) {
                    tools.adminShow('编辑商品',"<?php echo url($ctrl.'/'.$action.'_edit'); ?>?id=" + row.id);
                }
            },
            <?php endif; if($rbac->check($ctrl.'/'.$action.'_deal')): ?>
           	up:{
              	name: "上架",
				icon: "fa fa-rss",
				dealItem:function(row){
					return row.status == 1;
				},
                callback: function(row) {
                	tools.dealItem("<?php echo url($ctrl.'/'.$action.'_deal'); ?>",row.id,2,'确定要上架该商品吗？');
                }
            },
			down:{
               	name: "下架",
               	icon: "fa fa-power-off",
               	dealItem:function(row){
					return row.status == 2;
				},
               	callback: function(row) {
               		tools.dealItem("<?php echo url($ctrl.'/'.$action.'_deal'); ?>",row.id,1,'确定要下架该商品吗？');
                }
			},
			<?php endif; if($rbac->check($ctrl.'/'.$action.'_del')): ?>
            del:{
            	name: "删除",
                icon: "fa fa-trash-o",
                dealItem:function(row){
					return row.status == 1;
				},
                callback: function(row) {

                console.log(row);
                	tools.delItem("<?php echo url($ctrl.'/'.$action.'_del'); ?>",[row.id],'商品');
                }
            },
            <?php endif; ?>
        },
        colModel: [{
            display: 'checkbox',
            name: 'id',
            width: '15px'
        }, {
            display: '商品名',
            name: 'goods_name',
        },{
            display: '所属分类',
            name: 'category_name',
        }, {
            display: '总库存',
            name: 'num',
        }, {
            display: '售价',
            name: 'price',
        }, {
            display: '市场价',
            name: 'saleprice',
        }, {
            display: '状态',
            name: 'status',
            dealItem:function(row){
            	var statusCfg = {
            		1:'<span class="layui-badge" onclick="goodsSet('+row.id+',\'status\',2)" style="height: auto; white-space: nowrap;cursor:pointer;">下架</span>',
            		2:'<span class="layui-badge layui-bg-green" onclick="goodsSet('+row.id+',\'status\',1)" style="height: auto; ' + 'white-space: nowrap;cursor:pointer;">上架</span>',
            	}
            	return statusCfg[row.status];
            }
        },  {
            display: '添加时间',
            name: 'addtime',
            dealItem:function(row){
               return moment(row.addtime * 1000).format("YYYY-MM-DD HH:mm:ss");
            }
        }, {
            display: '操作',
            name: 'dealtools',
        }, ]
    });
}

</script>

</html>