<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:48:"E:\workspace\B2C\template\admin\index\login.html";i:1554195608;s:43:"E:\workspace\B2C\template\admin\layout.html";i:1554195608;}*/ ?>
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
		
	<link rel="stylesheet" type="text/css" href="/admin/login.css">


	</head>
	
<script language="JavaScript">
    if(window !=top){
            top.location.href = location.href;
      }
    function checkBrowser(){
        var ua = navigator.userAgent.toLocaleLowerCase();
        var browserType=null;
        if (ua.match(/msie/) != null || ua.match(/trident/) != null) {
            browserType = "IE";
            browserVersion = ua.match(/msie ([\d.]+)/) != null ? ua.match(/msie ([\d.]+)/)[1] : ua.match(/rv:([\d.]+)/)[1];
        } else if (ua.match(/firefox/) != null) {
            browserType = 1001;//"火狐";
        }else if (ua.match(/ubrowser/) != null) {
            browserType = "UC";
        }else if (ua.match(/opera/) != null) {
            browserType = "欧朋";
        } else if (ua.match(/bidubrowser/) != null) {
            browserType = "百度";
        }else if (ua.match(/metasr/) != null) {
            browserType = "搜狗";
        }else if (ua.match(/tencenttraveler/) != null || ua.match(/qqbrowse/) != null) {
            browserType = "QQ";
        }else if (ua.match(/maxthon/) != null) {
            browserType = "遨游";
        }else if (ua.match(/chrome/) != null) {
            var is360 = _mime("type", "application/vnd.chromium.remoting-viewer");
            function _mime(option, value) {
                var mimeTypes = navigator.mimeTypes;
                for (var mt in mimeTypes) {
                    if (mimeTypes[mt][option] == value) {
                        return true;
                    }
                }
                return false;
            }
            if(is360){
                browserType = '360';
            }else{
                browserType =1001;// "谷歌";
            }

        }else if (ua.match(/safari/) != null) {
            browserType = "Safari";
        }
        return browserType;
    }




</script>
<style>

    .login-page a{
        color:white;
        text-decoration:underline;
    }
</style>
<body class="login-body"  >
    <div class="login-page">
        <div class="login-form" id="login-form" style="display: none;">
            <div class="form-item">
                <label>用户名</label>
                <div class="form-input">
                    <input type="text" style="width:96%;" id="username">
                </div>
            </div>
            <div class="form-item">
                <label>密　码</label>
                <div class="form-input">
                    <input type="password" style="width: 96%;" id="password" >
                </div>
            </div>
            <div class="form-item" id="login-btn">
                <button>登录</button>
            </div>
            <div style="padding:10px;background-color:#000000;color:white;position: relative;top:40%;">为了您更好的用户体验，并访问所有的功能，我<br>们建议使用以下浏览器:<br><img width="15" src="/guge.png"><a href="http://www.downza.cn/soft/26885.html">谷歌浏览器下载</a>&nbsp;&nbsp;&nbsp;&nbsp; <img width="15" src="/huohu.png"><a href="http://www.firefox.com.cn/">火狐浏览器下载</a></div>
        </div>
        <div id="noshow" style="padding:10px;background-color:#000000;color:white;position: absolute;top:40%;display: none;"><h2>为了您更好的用户体验，并访问所有的功能，我<br>们建议使用以下浏览器:<br><img width="20" src="/guge.png"><a href="http://www.downza.cn/soft/26885.html">谷歌浏览器下载</a> &nbsp;&nbsp;&nbsp;&nbsp;   <img width="20" src="/huohu.png"><a href="http://www.firefox.com.cn/">火狐浏览器下载</a></h2></div>

    </div>
    <script type="text/javascript">
        if(checkBrowser()!=1001){
            alert('对不起，您的浏览器不支持，建议使用谷歌或者火狐浏览器访问');
            document.getElementById("login-form").style.display="none";
            document.getElementById("noshow").style.display="block";
        }else{
            document.getElementById("login-form").style.display="block";
            document.getElementById("noshow").style.display="none";
        }
    	window.recall = function(){
    		$("#login-btn").on("click",function(){
    			if(tools.onLoading){
    				return false;
    			}
    			var username = $.trim($("#username").val());
    			var password = $.trim($("#password").val());
    			if(!username || !password){
    				layer.error('用户名或密码不能为空');
    				return false;
    			}
    			$.ajax({
    				url: "<?php echo url('index/login'); ?>",
    				type: 'post',
    				dataType: 'json',
    				data: {username:username,password:password},
    				beforesend:function(){
    		            layer.loading();
    		            tools.onLoading = true;
    		        }
    			})
    			.done(function(r) {
    				tools.onLoading = false;
    				layer.closeAll();
    				if(r.status == 1){
    					window.location.href="<?php echo url('index/index'); ?>";
    					return false;
    				}
    				layer.error(r.info);
    			})
    			.fail(function() {
    				layer.close(loadIndex);
    				tools.onLoading = false;
    				layer.error('服务器错误，请稍后重试');
    			});
    		});
            //回车键触发提交
            $("body").keydown(function(event){
                if (event.keyCode == 13) {
                    document.getElementById("login-btn").click();
                }
            })

    	}
    </script>

</body>

</html>