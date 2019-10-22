<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:48:"E:\workspace\B2C\template\admin\count\index.html";i:1554195608;s:43:"E:\workspace\B2C\template\admin\layout.html";i:1554195608;}*/ ?>
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
	    <div class="count-item-list">
	    	<div class="count-item" data-url="<?php echo url('count/count_sale'); ?>">
	    		<img alt="折线图" src="/o_1c98tjfvf1l7k9t6g1rhr41m41b.png">
	    		<div class="title">销售额统计</div>
	    	</div>
	    	<div class="count-item" data-url="<?php echo url('count/count_goods'); ?>">
	    		<img alt="表格" src="/o_1cdn7elhu1ucqpo81b4ur3bh2qc.png">
	    		<div class="title">商品销量统计</div>
	    	</div>
	    </div>
	</body>
	<script>
	window.recall = function(){
		$(".count-item").on("click",function(){
			var url = $(this).data('url');
			var title = $(this).find('.title').text();
			tools.adminShow(title, url);
		});
	}
	</script>

</html>