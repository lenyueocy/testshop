<?php
namespace Helper;

use QiniuSdk\Qiniu;
use Common\Functions;
class Html
{
    private $categoryHtml = '';
    
    public function category($category,$select = true) {
        $this->categoryHtml = '';
        if ($select === true) {
            $this->categoryHtml = '<select name="categoryid" class="layui-input" lay-search><option  value="0">全部商品</option>';
            $this->categorySelect($category);
            $this->categoryHtml.= '</select>';
            return $this->categoryHtml;
        }
        $this->categoryCell($category);
        return $this->categoryHtml;
    }
    
    private function categorySelect($category,$pid=0){
        foreach ($category as $cate) {
            if ($cate['parentid'] == $pid) {
                $this->categoryHtml .= '<option value="'.$cate['id'].'">'.$this->levelNbsp($cate['level']).$cate['title'].'</option>';
                $this->categorySelect($category,$cate['id']);
            }
        }
    }
    
    private function categoryCell($category,$pid=0) {
        foreach ($category as $cate) {
            if ($cate['parentid'] == $pid) {
                $this->categoryHtml .= $this->levelNbsp($cate['level']).'<div class="opt-item" data-id="'.$cate['id'].'">'.$cate['title'].'</div>';
                $this->categoryCell($category,$cate['id']);
            }
        }
    }
    
    private function levelNbsp($level) {
        $nbsp = '';
        $num = ($level-1)*3;
        for ($i = 0; $i < $num; $i++) {
            $nbsp.='&nbsp;';
        }
        return $nbsp;
    }
    
    
    private $inputArr = [
        'name'=>'',
        'class'=>'layui-input',
        'lay-verify'=>'',
        'placeholder'=>'',
        'label'=>'',
        'value'=>'',
        'ext'=>''
    ];
    /**
     * 输入框
     * @param array $opt 
     */
    public function input($opt) {
        if (!isset($opt['placeholder']) || !$opt['placeholder']) {
            $opt['placeholder'] = '请输入'.$opt['label'];
        }
        $opt = self::defaultOpt($this->inputArr, $opt);
        $input = '<input id="layinput-'.$opt['name'].'"'.self::optionHtml($opt).'/>';
        return self::formItem($opt, $input);
    }
    
    private $selectArr = [
        'name'=>'',
        'class'=>'layui-input',
        'lay-verify'=>'',
        'label'=>'',
        'options'=>[
        ],
        'value'=>'',
        'ext'=>''
    ];
    /**
     * 下拉选择框
     * @param array $opt
     * @param string $value
     * @param string $title
     */
    public function select($opt,$value=false,$title=false) {
        $opt = self::defaultOpt($this->selectArr, $opt);
        $input = '<select id="layinput-'.$opt['name'].'"'.self::optionHtml($opt).'lay-search lay-filter="'.$opt['name'].'">'.self::selectOptions($opt,$value,$title).'</select>';
        return self::formItem($opt, $input);
    }
    
    private $radioArr = [
        'name'=>'',
        'class'=>'layui-input',
        'lay-verify'=>'',
        'label'=>'',
        'options'=>[
        ],
        'value'=>'',
        'title'=>'',
        'ext'=>''
    ];
    public function radio($opt,$value=false,$title=false) {
        $opt = self::defaultOpt($this->radioArr, $opt);
        $input = '';
        $orgValue = $opt['value'];
        foreach ($opt['options'] as $key=>$val) {
            if ($value === false || $title === false) {
                $checked = $key == $orgValue ? 'checked' : '';
                $opt['value'] = $key;
                $opt['title'] = $val;
            }else{
                $checked = $val[$value] == $orgValue ? 'checked' : '';
                $opt['value'] = $val[$value];
                $opt['title'] = $val[$title];
            }
            $input .= '<input type="radio" id="layinput-'.$opt['name'].'-'.$opt['value'].'" '.$checked.self::optionHtml($opt).' lay-filter="filter-'.$opt['name'].'" />';
        }
        return self::formItem($opt, $input,false,true);
    }
    
    private $textareaArr = [
        'name'=>'',
        'class'=>'layui-input layui-textarea',
        'lay-verify'=>'',
        'placeholder'=>'',
        'label'=>'',
        'value'=>'',
        'ext'=>''
    ];
    public function textarea($opt) {
        $opt = self::defaultOpt($this->textareaArr, $opt);
        $orgValue = $opt['value'];
        unset($orgValue);
        $input = '<textarea id="layinput-'.$opt['name'].'"'.self::optionHtml($opt).'>'.$opt['value'].'</textarea>';
        return self::formItem($opt, $input,'layui-form-text');
    }
    
    private $imagesArr = [
        'images'=>[],
        'field'=>'',
        'label'=>''
    ];
    public function images($opt) {
        $opt = self::defaultOpt($this->imagesArr, $opt);
        $domain = '';//Qiniu::getDomain();
        $i = 0;$img = '';
        foreach ($opt['images'] as $row) {
            $img .= '<div class="image-item">
                <i class="fa fa-times image-item-del"></i>
                <img src="'.$domain.$row['filekey'].'" alt="">
                <input type="hidden" name="'.$opt['field'].'['.$i.'][id]" value="'.$row['fid'].'">
                <input type="hidden" name="'.$opt['field'].'['.$i.'][key]" value="'.$row['filekey'].'">
            </div>';
            $i++;
        }
        return '<div class="layui-form-item layui-form-text">
                <label class="layui-form-label">'.$opt['label'].'</label>
            </div>
            <div class="upload-img-list" id="upload-container-'.$opt['field'].'">
                '.$img.'
                <i class="fa fa-plus upload-plus" id="upload-btn-'.$opt['field'].'"></i>
            </div>';
    }
    
    public function formBegin($id=false,$sign=false) {
        $hidden = '';
        if ($id !== false) {
            $hidden .= '<input type="hidden" name="id" value="'.$id.'" >';
        }
        if ($sign !== false) {
            $sign = $sign ? $sign : Functions::randStr(20);
            $hidden .= '<input type="hidden" name="sign" value="'.$sign.'" >';
        }
        return '<form class="layui-form layui-form-pane" onsubmit="return false;" layui-filter="adminFrom">'.$hidden;
    }
    
    public function formEnd($url,$filter=false) {
        $f = $filter === false ? 'subform' : $filter;
        return '<div class="layui-footer">
				<div class="layui-form-item">
					<div class="layui-input-block">
						<button class="layui-btn" lay-submit lay-filter="'.$f.'" data-url="'.$url.'">立即提交</button>
						<button type="reset" class="layui-btn layui-btn-primary">重置</button>
					</div>
				</div>
			</div>
		</form>';
    }
    
    private static function selectOptions($opt,$value,$title){
        $optStr = '<option value="">请选择'.$opt['label'].'</option>';
        foreach ($opt['options'] as $key=>$val) {
            //针对[1=>'dd',2=>'ee']
            if ($value === false || $title === false) {
                $selected = $key == $opt['value'] ? 'selected' : '';
                $optStr .='<option value="'.$key.'" '.$selected.'>'.$val.'</option>';
                continue;
            }
            //针对[0=>'aa',1=>'bb']值和键相同的
            if ($value === $title) {
                $selected = $val == $opt['value'] ? 'selected' : '';
                $optStr .='<option value="'.$val.'" '.$selected.'>'.$val.'</option>';
                continue;
            }
            //针对[['id'=>1,'title'=>'lalla']]
            $selected = $val[$value] == $opt['value'] ? 'selected' : '';
            $optStr .='<option value="'.$val[$value].'" '.$selected.'>'.$val[$title].'</option>';
        }
        return $optStr;
    }
    
    private static function formItem($opt,$input,$extClass=false,$pane = false){
        $ext = $extClass === false ? '' : ' '.$extClass;
        return '<div class="layui-form-item'.$ext.'" '.($pane === false ? '' : 'pane').'>
                    <label class="layui-form-label">
                        '.self::isRequired($opt).$opt['label'].'
                    </label>
                    <div class="'.(isset($opt['tip']) && $opt['tip'] ? 'layui-input-inline' : 'layui-input-block').'">
                        '.$input.'
                    </div>
                    '.(isset($opt['tip']) && $opt['tip'] ? '<div class="layui-form-mid layui-word-aux">'.$opt['tip'].'</div>' : '').'
                </div>';
    }
    
    private static function isRequired($opt){
        return strpos($opt['lay-verify'], 'required') === false ? '' : '<span class="tip-red">*</span>';
    }
    
    const INPUT_OPTION = ['name','lay-verify','value','placeholder','class','title'];
    private static function optionHtml($opt){
        $html = ' ';
        if (!isset($opt['placeholder']) || !trim($opt['placeholder'])) {
            $opt['placeholder'] = '请输入'.$opt['label'];
        }
        foreach ($opt as $key=>$val) {
            if (!in_array($key, self::INPUT_OPTION)) {
                continue;
            }
            $html.=$key.'="'.trim($val).'" ';
        }
        return $html.$opt['ext'].' ';
    }
    
    private static function defaultOpt($defaultArr,$opt) {
        foreach ($defaultArr as $key=>$val) {
            if (is_array($val)) {
                if (isset($opt[$key]) && is_array($opt[$key])) {
                    $opt[$key] = $val+$opt[$key];
                }else{
                    $opt[$key] = $val;
                }
            }else{
                if (isset($opt[$key])) {
                    $opt[$key] = trim($val.' '.$opt[$key]);
                }else{
                    $opt[$key] = trim($val);
                }
            }
        }
        return $opt;
    }
}