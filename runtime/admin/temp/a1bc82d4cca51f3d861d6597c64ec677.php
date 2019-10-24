<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"D:\workspace\testshop\template\admin\member\user\add.html";i:1571826762;s:48:"D:\workspace\testshop\template\admin\layout.html";i:1571823436;}*/ ?>
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
    <?php echo $html->formBegin(); ?>
    <div class="layui-body" style="top: 0;">
        <div class="layui-tab">
            <ul class="layui-tab-title">
                <li class="layui-this">添加用户</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <div class="layui-form-item">
                        <label class="layui-form-label">昵称</label>
                        <div class="layui-input-block">
                            <input lay-verify="required|text" name="nickname" placeholder="请输入昵称" class="layui-input" value="">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">手机号</label>
                        <div class="layui-input-block">
                            <input lay-verify="required|phone" name="mobile" placeholder="请输入手机号码" class="layui-input" value="">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">头像</label>
                        <div class="layui-input-block">
                            <input type="hidden" name="headpic" value="">
                            <button type="button" class="layui-btn" id="headpic">
                                <i class="layui-icon">&#xe67c;</i>上传图片
                            </button>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">地址</label>
                        <div class="layui-input-block">
                            <input lay-verify="required|text" name="address" placeholder="请输入地址" class="layui-input" value="">
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <?php echo $html->formEnd(url($ctrl."/".$action."_add")); ?>
</div>
</body>

<script type="text/javascript">
    layui.use('upload',function () {
        var upload = layui.upload;
        var uploadInst = upload.render({
            elem: '#headpic'
            ,url: "<?php echo url('member/ajaxUploadImage'); ?>"
            ,done: function(res){
                this.elem.prev().val(res.data.url)
                layer.msg("上传图片成功");
            }
            ,error: function(){
                layer.msg("上传图片出现错误");
            }
        })
    })
</script>

</html>