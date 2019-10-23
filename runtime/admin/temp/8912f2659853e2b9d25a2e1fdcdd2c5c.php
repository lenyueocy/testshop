<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"E:\workspace\testshop\template\admin\goods\goods\edit.html";i:1571710914;s:48:"E:\workspace\testshop\template\admin\layout.html";i:1571710914;}*/ ?>
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
		<?php echo $html->formBegin($detail['id'],$detail['sign']); ?>
			<div class="layui-body" style="top: 0;">
				<div class="layui-tab">
					<ul class="layui-tab-title">
						<li class="layui-this">基本信息</li>
						<li class="">分类信息</li>
						<li class="">图片信息</li>
					</ul>
					<div class="layui-tab-content">
						<div class="layui-tab-item layui-show">
							<?php echo $html->input([
								'label'=>'标题',
								'lay-verify'=>'required|title',
								'name'=>'title',
								'value'=>$detail['title']
							]); ?>
							<?php echo $html->input([
							'label'=>'关键字',
							'lay-verify'=>'required|entitle',
							'name'=>'entitle',
							'value'=>$detail['entitle']
							]); ?>
							
							<?php echo $html->input([
								'label'=>'价格',
								'lay-verify'=>'required|number',
								'name'=>'price',
								'value'=>$detail['price']
							]); ?>
							
							<?php echo $html->input([
								'label'=>'市场价格',
								'lay-verify'=>'required|number',
								'name'=>'saleprice',
								'value'=>$detail['saleprice']
							]); ?>
							<?php echo $html->input([
							'label'=>'单位名',
							'lay-verify'=>'required|unitname',
							'name'=>'unit_name',
							'value'=>$detail['unit_name']
							]); ?>

							<?php echo $html->input([
								'label'=>'总库存',
								'lay-verify'=>'required|number',
								'name'=>'num',
								'value'=>$detail['num']
							]); ?>

							<?php echo $html->input([
								'label'=>'剩余库存',
								'lay-verify'=>'required|number',
								'name'=>'leftnum',
								'value'=>$detail['leftnum']
							]); ?>

							<?php echo $html->input([
							'label'=>'预售开始',
							'lay-verify'=>'required',
							'name'=>'salestart',
							'placeholder'=>'请选择预售开始时间',
							'value'=>$detail['salestart']
							]); ?>
							<?php echo $html->input([
							'label'=>'预售结束',
							'lay-verify'=>'required',
							'name'=>'saleend',
							'placeholder'=>'请选择预售结束时间',
							'value'=>$detail['saleend']
							]); ?>
							<div class="layui-form-item">
								<label class="layui-form-label"><span class="tip-red">*</span>配送格式</label>
								<div class="layui-input-block">
									<select name="ptype" required lay-verify="required" lay-filter="pType">
										<option value=""></option>
										<option value="0">配送时间</option>
										<option value="1">配送文本</option>
									</select>
								</div>
							</div>
							<?php echo $html->input([
							'label'=>'配送方式',
							'name'=>'types',
							'value'=>$detail['types']
							]); ?>
							<?php echo $html->input([
								'label'=>'配送时间',
								'name'=>'send',
								'placeholder'=>'请选择配送时间',
								'tip'=>'配送时间,配送文本两者选其一填写',
								'value'=>$detail['send']
							]); ?>

							<?php echo $html->input([
							'label'=>'配送文本',
							'lay-verify'=>'sendtxt',
							'name'=>'sendtxt',
							'placeholder'=>'请选择配送文本',
							'tip'=>'配送文本最多6个字符',
							'value'=>$detail['sendtxt']
							]); ?>
							<?php echo $html->input([
								'label'=>'排序',
								'lay-verify'=>'required|number',
								'name'=>'sort',
								'tip'=>'排序号，越大排越前',
								'value'=>$detail['sort']
							]); ?>
							
							<div class="layui-form-item" pane>
								<label class="layui-form-label">标签</label>
								<div class="layui-input-block">
									<?php if(is_array($tags) || $tags instanceof \think\Collection || $tags instanceof \think\Paginator): $i = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
										<input type="checkbox" name="tag[<?php echo $vo['field']; ?>]" title="<?php echo $vo['title']; ?>" value="1" <?php echo $detail[$vo['field']]==1?'checked' : ''; ?>>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>
			            </div>
			            <div class="layui-tab-item">
							<div class="layui-form-item layui-form-text">
			                    <label class="layui-form-label"><span class="tip-red">*</span>商品分类</label>
			                    <div class="layui-input-block muti-select" data-type="1" data-field="category">
			                        <div class="muti-select-opt">
			                        	<?php echo $html->category($category,false); ?>
			                        </div>
			                        <div class="muti-select-btn">
			                            <button class="layui-btn layui-btn-sm layui-btn-normal muti-select-all-left"><<全选</button>
			                            <button class="layui-btn layui-btn-sm muti-add-btn">添加>></button>
			                            <button class="layui-btn layui-btn-sm layui-btn-warm muti-remove-btn"><<移除</button>
			                            <button class="layui-btn layui-btn-sm layui-btn-normal muti-select-all-right">全选>></button>
			                        </div>
			                        <div class="muti-select-items">
			                        </div>
			                        <span class="muti-input" style="display: none;"></span>
			                    </div>
			                </div>
						</div>
			            <div class="layui-tab-item">

							<?php echo $html->images([
								'field'=>'single',
								'label'=>'商品主图',
								'images'=>$detail['single']
							]); ?>
							<?php echo $html->images([
								'field'=>'atlas',
								'label'=>'商品详情图片',
								'images'=>$detail['atlas']
							]); ?>
						</div>
					</div>
				</div>
			</div>
		<?php echo $html->formEnd(url($ctrl."/".$action."_edit")); ?>
	</div>
</body>
<script>

    //转化正整数
    function zhzs(value){

        value = value.replace(/[^\d]/g,'');
        if(''!=value){
            value = parseInt(value);
        }
        return value;

    }

</script>
<script type="text/javascript">
	var goodsCate = <?php echo json_encode($goodsCate); ?>;
	window.recall = function(){

        form.verify({
            title: function(value){ //value：表单的值、item：表单的DOM对象
                if(value.length > 40){
                    return '标题不得超40个字符';
                }
            },

            unitname: function(value){ //value：表单的值、item：表单的DOM对象
            if(value.length > 2){
                return '单位名不得超2个字符';
            }
        },
            entitle: function(value){ //value：表单的值、item：表单的DOM对象
                if(value.length > 18){
                    return '关键字不得超18个字符';
                }
            },
            sendtxt: function(value){ //value：表单的值、item：表单的DOM对象
                if(value.length > 6){
                    return '配送文本不得超6个字符';
                }
            }

        });

		laydate.render({ 
	  		elem: '#layinput-send',
	  		type: 'datetime'
		});
        laydate.render({
            elem: '#layinput-salestart',
            type: 'datetime'
        });
        laydate.render({
            elem: '#layinput-saleend',
            type: 'datetime'
        });

		$(".upload-img-list").on("click",'#upload-btn-single',function(){
            window.uploadConfig = {
                num : 5,
                container : "#upload-container-single",
                mark : 'single',
                chooseFunc : tools.chooseFile
            }
            tools.adminShow('商品图片,最多5张',"<?php echo url('file/choose'); ?>");
        });
		
		$(".upload-img-list").on("click",'#upload-btn-atlas',function(){
            window.uploadConfig = {
                num : 10,
                container : "#upload-container-atlas",
                mark : 'atlas',
                chooseFunc : tools.chooseFile
            }
            tools.adminShow('商品详情图片,最多10张',"<?php echo url('file/choose'); ?>");
        });
        
        $(".muti-select").on('click',".opt-item", function() {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            }else{
                $(this).addClass('active');
            }
        });

        $(".muti-select").on('click', '.muti-add-btn', function() {
            var selectHtml = '';
            var parentObj = $(this).parents('.muti-select');
            parentObj.find('.muti-select-opt .active').each(function(index, el) {
                $(this).removeClass('active');
                if (parentObj.data('type') == 1) {
                	selectHtml+=$(this).prop("outerHTML");
                }else{
                	var obj = $($(this).prop("outerHTML"));
	                obj.prepend('<input class="layui-input muti-num-input" name="num[]" lay-verify="required|number|ltZero" placeholder="数量">');
	                selectHtml+=obj.prop("outerHTML");
                }
                $(this).hide();
            });
            parentObj.find(".muti-select-items").append(selectHtml);
            mutiSelect(parentObj);
        });

        $(".muti-select").on('click', '.muti-remove-btn', function() {
        	var parentObj = $(this).parents('.muti-select');
            parentObj.find('.muti-select-items .active').each(function(index, el) {
                var selectId = $(this).data('id');
                parentObj.find('.muti-select-opt div[data-id="'+selectId+'"]').show();
                $(this).remove();
            });
            mutiSelect(parentObj);
        });

        $(".muti-select").on('click', '.muti-select-all-left', function() {
        	var parentObj = $(this).parents('.muti-select');
            parentObj.find('.muti-select-opt .opt-item').each(function(index, el) {
                if ($(this).css('display') != 'none') {
                    $(this).addClass('active');
                }
            });
        });

        $(".muti-select").on('click', '.muti-select-all-right', function() {
        	var parentObj = $(this).parents('.muti-select');
            parentObj.find('.muti-select-items .opt-item').addClass('active');
        });
        
        for(var key in goodsCate){
			$(".muti-select-opt").find('.opt-item[data-id="'+goodsCate[key]+'"]').addClass('active');
		}
		$(".muti-add-btn").click();
        //回显
		var pTxt=$("input[name='sendtxt']").val();
		if(pTxt==""||pTxt==null){
            $("input[name='send']").parent().parent().show();
            $("input[name='sendtxt']").parent().parent().hide();
            $("select[name='ptype']").find("option").eq(1).prop("selected",true);
		}else {
            $("input[name='send']").parent().parent().hide();
            $("input[name='sendtxt']").parent().parent().show();
            $("select[name='ptype']").find("option").eq(2).prop("selected",true);
		}
        $("input[name='types']").parent().parent().hide();
        form.render();
        form.on('select(pType)', function(data){
            var ptype=$("select[name='ptype']").find("option:selected").html();
            if(ptype=="配送时间"){
                // var sendtxt=$("input[name='sendtxt']").val();
                // var send=$("input[name='send']").val();
                // console.log(sendtxt);
                // console.log(send);
                $("input[name='send']").parent().parent().show();
                $("input[name='sendtxt']").parent().parent().hide();
                $("input[name='types']").val('0')

            }else{
                $("input[name='send']").parent().parent().hide();
                $("input[name='sendtxt']").parent().parent().show();
                $("input[name='types']").val('1')
            }
            form.render();
        });

    }
	function mutiSelect(parentObj){
        var inputStr = '';
        var name = parentObj.data('field');
        parentObj.find('.muti-select-items .opt-item').each(function(index, el) {
            var selectId = $(this).data('id');
            inputStr += '<input type="hidden" name="'+name+'[]" value="'+selectId+'">';
        });
        parentObj.find('.muti-input').html(inputStr);
    }
</script>

</html>