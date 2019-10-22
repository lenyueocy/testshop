<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"E:\workspace\B2C\template\admin\goods\category\list.html";i:1554195608;s:43:"E:\workspace\B2C\template\admin\layout.html";i:1554195608;}*/ ?>
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
		                <div class="layui-input-inline" style="width:40px">
		                    <a class="layui-btn layui-btn-sm" href="">
		                        <i class="fa fa-refresh"></i>
		                    </a>
		                </div>
		            </div>
					<div class="layui-btn-group layui-layout-right">
						<?php if($rbac->check($ctrl.'/'.$action.'_add')): ?>
						<button class="layui-btn layui-btn-sm win-open" data-url="<?php echo url($ctrl.'/'.$action.'_add'); ?>?pid=0">
							<i class="fa fa-plus-circle"></i>添加
						</button>
						<?php endif; if($rbac->check($ctrl.'/'.$action.'_sort')): ?>
						<button class="layui-btn layui-btn-sm" id="sort-btn">
							<!--<i class="fa fa-sort-numeric-desc"></i>-->更新排序
						</button>
						<?php endif; ?>
					</div>
		        </div>
		    </form>
		</div>
		<div class="layui-body table_box">
			<div class="table_content">
				<table class="layui-table" width="0" border="0" cellspacing="0" cellpadding="0" style="">
					<thead>
						<tr>
							<th style="width: 40px">排序</th>
							<th class="">标题</th>
							<th style="width: 130px">操作</th>
						</tr>
					</thead>
					<tbody class="et_tbody" style="position:relative;"></tbody>
				</table>
			</div>
		</div>
	</div>
</body>
<script>
var categoryData = <?php echo json_encode($category); ?>;
var categoryTree = [];
var levelLimit = 1;
var delArr = [];
window.recall=function(){
    categoryTree = pageTool.toTree(categoryData);
    pageTool.init();
    
    $(".table_box").on('click', '.show-dict', function() {
    	pageTool.showHide[$(this).parents('tr').data('id')] = 2;
    	pageTool.init();
    });

    $(".table_box").on('click', '.hide-dict', function() {
    	pageTool.showHide[$(this).parents('tr').data('id')] = 1;
    	pageTool.init();
    });

    $(".table_box").on('click', '.del-menu', function() {
    	var thisid = $(this).parents('tr').data('id');
    	delArr = [thisid];
    	pageTool.forFn(thisid);
    	layer.confirm('确定要删除该分类吗？',function(){
    		layer.closeAll();
    		tools.ajax("<?php echo url($ctrl.'/'.$action.'_del'); ?>",{dataId:delArr},function(data){
	    		layer.success('删除成功');
		        setTimeout(function(){
					pageTool.refresh();
		        },1500);
	    	});
    	})
    });

    $("#sort-btn").on('click', function() {
    	var sortArr = [];
    	$(".et_tbody").find('tr').each(function(index, el) {
    		var obj = {
    			'id':$(this).data('id'),
    			'sort':$(this).find('input').val()
    		}
    		sortArr.push(obj);
    	});
    	tools.ajax("<?php echo url($ctrl.'/'.$action.'_sort'); ?>",{sort:sortArr},function(data){
    		categoryData = data;
    		categoryTree = pageTool.toTree(categoryData);
    		pageTool.init();
    	});
    });
}

var pageTool = {
	html:'',
	showHide:{},
	init:function(){
		this.html = '';
		$(".table_box .et_tbody").html(pageTool.treeToHtml(categoryTree,1));
	},

	forFn:function(pid){
		for (key in categoryData) {
			if (categoryData[key].parentid == pid) {
				delArr.push(categoryData[key].id);
				this.forFn(categoryData[key].id);
			}
		}
    },
	refresh:function(){
		tools.ajax("<?php echo url($ctrl.'/'.$action.'_list'); ?>",{},function(data){
    		categoryData = data;
    		categoryTree = pageTool.toTree(categoryData);
    		pageTool.init();
    	});
	},
	treeToHtml:function(node,lev,pshow){
		if (lev > levelLimit) {
			return '';
		}
		for (key in node) {
			var showBtn = '',trHide='',addBtn = '';
			if (lev < levelLimit) {
				<?php if($rbac->check($ctrl.'/'.$action.'_add')): ?>
				addBtn = '<i class="fa fa-plus dict-fa win-open" style="background-color: #009688" data-url="<?php echo url($ctrl.'/'.$action.'_add'); ?>?pid='+node[key].id+'" data-title="添加节点"></i>';
				<?php endif; ?>
				if (!this.showHide[node[key].id]) {
					this.showHide[node[key].id] = 2;
				}
				if (this.showHide[node[key].id] == 1) {
					showBtn = '<i class="fa fa-plus show-dict" style="cursor: pointer;border: solid 1px;padding: 3px;margin-right:5px;"></i>';
				}else{
					showBtn = '<i class="fa fa-minus hide-dict" style="cursor: pointer;border: solid 1px;padding: 3px;margin-right:5px;"></i>';
				}
			}
			if (this.showHide[node[key].parentid] == 1 || pshow === false) {
				trHide='display:none;';
				pshow = false;
			}else{
				pshow = true;
			}

			this.html += '<tr style="'+trHide+'" data-id="'+node[key].id+'" data-pid="'+node[key].parentid+'" style="">'+
			    '<td>'+
			        '<input type="text" name="sort" value="'+node[key].sort+'" class="layui-input">'+
			    '</td>'+
			    '<td style="padding-left:'+(10+(lev-1)*60)+'px;">'+showBtn+node[key].title+'</td>'+
			    '<td style="text-align: center;">'+addBtn;
	    	<?php if($rbac->check($ctrl.'/'.$action.'_edit')): ?>
				this.html +='<i class="fa fa-pencil dict-fa win-open" data-url="<?php echo url($ctrl.'/'.$action.'_edit'); ?>?id='+node[key].id+'" data-title="编辑节点" style="background-color: #009688"></i>';
        	<?php endif; if($rbac->check($ctrl.'/'.$action.'_del')): ?>
				this.html +='<i class="fa fa-trash dict-fa del-menu" style="background-color: #FF5722"></i>';
	        <?php endif; ?>
			this.html +='</td></tr>';
			
			if (node[key].children) {
				this.treeToHtml(node[key].children,lev+1,pshow);
			}
		}
		return this.html;
	},
	toTree: function(data) {
        var map = {};
        data.forEach(function (item) {
            map[item.id] = item;
        });

        var val = [];
        data.forEach(function (item) {
            var parent = map[item.parentid];
            if (parent) {
                (parent.children || ( parent.children = [] )).push(item);
            } else {
                val.push(item);
            }
        });
        return val;
    }
}

</script>

</html>