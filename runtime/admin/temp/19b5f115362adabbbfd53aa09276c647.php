<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"D:\workspace\testshop\template\admin\order\order\list.html";i:1571823436;s:48:"D:\workspace\testshop\template\admin\layout.html";i:1571823436;}*/ ?>
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
		        	<div class="layui-form-item">
		        		<div class="layui-input-inline">
		                    <select class="layui-input" name="status">
		                    	<option value="">订单状态</option>
		                    	<option value="-1">已取消</option>
		                    	<option value="1">待支付</option>
		                    	<option value="2">待发货</option>
		                    	<option value="3">已发货</option>
		                    	<option value="4">待提货</option>
		                    	<option value="5">已完成</option>
		                    </select>
		                </div>
		                <div class="layui-input-inline">
		                    <input class="layui-input" placeholder="开始日期" id="start" name="start">
		                </div>
		                <div class="layui-input-inline">
		                    <input class="layui-input" placeholder="截止日期" id="end" name="end">
		                </div>
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
						<?php if($rbac->check($ctrl.'/'.$action.'_send')): ?>
						<button class="layui-btn layui-btn-sm batch-deal-btn" data-url="<?php echo url($ctrl.'/'.$action.'_send'); ?>" data-msg="确定要将已选中的订单标记为已发货吗？" data-val="3">
							<i class="fa fa-paper-plane"></i>发货
						</button>
						<?php endif; if($rbac->check($ctrl.'/'.$action.'_export')): ?>
						<button class="layui-btn layui-btn-sm export-btn" lay-submit lay-filter="form-export">
							<i class="fa fa-upload"></i>导出
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

        if (field.status) {
            searchWhere['a.status'] = field.status;
        }
        if (field.fromid) {
            searchWhere['a.fromid'] = field.fromid;
        }
        if (field.start) {
        	searchWhere['a.addtime'] = ['>=', field.start + ' 00:00:00'];
        }
        if (field.end) {
        	searchWhere['a.addtime'] = ['<=', field.end + ' 23:59:59'];
        }

        if (field.start && field.end) {
        	searchWhere['a.addtime'] = ['between', [field.start + ' 00:00:00', field.end + ' 23:59:59']];
        }
        if (field.keyword) {
            searchWhere['a.name|a.mobile|a.orderno|b.nickname'] = ['like', '%' + field.keyword + '%'];
        }
        adminTable.search(searchWhere);
        return false;
    });
    
    form.on('submit(form-export)', function(data) {
        var field = data.field;
        var searchWhere = {};

        if (field.status) {
            searchWhere['a.status'] = field.status;
        }
        if (field.fromid) {
            searchWhere['a.fromid'] = field.fromid;
        }
        if (field.start) {
        	searchWhere['a.addtime'] = ['>=', field.start + ' 00:00:00'];
        }
        if (field.end) {
        	searchWhere['a.addtime'] = ['<=', field.end + ' 23:59:59'];
        }

        if (field.start && field.end) {
        	searchWhere['a.addtime'] = ['between', [field.start + ' 00:00:00', field.end + ' 23:59:59']];
        }
        if (field.keyword) {
            searchWhere['a.name|a.mobile|a.orderno|b.nickname'] = ['like', '%' + field.keyword + '%'];
        }
        tools.ajax('<?php echo url("order/order_export"); ?>',{where:searchWhere},function(res){
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

        dealParam: {
        	<?php if($rbac->check($ctrl.'/'.$action.'_detail')): ?>
            detail: {
                name: "详情",
                icon: "fa fa-eye",
                callback: function(row) {
                	tools.adminShow('订单详情',"<?php echo url($ctrl.'/'.$action.'_detail'); ?>?id="+row.id);
                }
            },
        	<?php endif; if($rbac->check($ctrl.'/'.$action.'_send')): ?>
            sync: {
                name: "发货",
                icon: "fa fa-paper-plane",
                dealItem:function(row){
                    return row.status == 2;
                },
                callback: function(row) {
                	tools.dealItem("<?php echo url($ctrl.'/'.$action.'_send'); ?>",[row.id],3,'确定要将该订单标记为已发货吗？');
                }
            },
        	<?php endif; if($rbac->check($ctrl.'/'.$action.'_make')): ?>
                change: {
                    name: "备注",
                        icon: "fa fa-edit",
                        callback: function(row) {
                        tools.adminShow('订单备注',"<?php echo url($ctrl.'/'.$action.'_make'); ?>?id="+row.id);
                    }
                },
                <?php endif; ?>





        },
        colModel: [{
            display: 'checkbox',
            name: 'id',
            width: '15px'
        }, {
            display: '订单号',
            name: 'orderno',
        }, {
            display: '昵称',
            name: 'nickname',
            dealItem:function(row){
                if(row.nickname == null || row.nickname == undefined || row.nickname == ""){
                   // return row.nickname='【特殊字符】';
                    return row.nickname= '<span style="color: #FD482C;">【特殊字符】</span>'
                }else{
                    return row.nickname;
                }
            }
        }, {
            display: '头像',
            name: 'headpic',
            dealItem:function(row){
                if(!row.headpic){
                    return '<img  src="/admin/images/headpic-no.png"  style="max-height: 50px;">';
                }else{
                    return '<img src="'+row.headpic+'" style="max-height: 50px;">';
                }
            }
        }, {
            display: '手机号',
            name: 'mobile',
        }, {
            display: '地址',
            name: 'address',
            dealItem:function(row){
                return '<div  style="width:200px;">'+row.address+'</div>';
            }
        }, {
            display: '支付金额',
            name: 'orderfee',
        }, {
            display: '状态',
            name: 'status',
            dealItem:function(row){
                var statusCfg = {
               		'-1':'<span class="layui-badge layui-bg-black">已取消</span>',
               		1:'<span class="layui-badge layui-bg-gray">待付款</span>',
             		2:'<span class="layui-badge">待发货</span>',
              		3:'<span class="layui-badge layui-bg-orange">已发货</span>',
              		4:'<span class="layui-badge layui-bg-blue">待提货</span>',
               		5:'<span class="layui-badge layui-bg-green">已完成</span>',
                }
                if(row.refundstate == 1){
                    return '<div  style="width:70px;">'+statusCfg[row.status]+'<br><font color="red">已退款</font>'+'</div>';

                }
                return '<div  style="width:70px;">'+statusCfg[row.status]+'</div>';

            }
        },{
            display: '商户备注',
            name: 'comm_mark',
            dealItem:function(row){
                if(!row.comm_mark){
                    return    '<div ><font color="gray">无</font></div>';
                }else{
                    return  '<div ><font color="red">'+row.comm_mark+'</font></div>';
                }
            }
        }, {
            display: '添加时间',
            name: 'addtime'
        },{
            display: '操作',
            icon: 'fa fa-cog',
            width: '80px',
            name: 'dealtools'
        }]
    });
}
</script>

</html>