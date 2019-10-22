<?php
namespace Logic;

use Constants\SiteConst;
use QiniuSdk\Qiniu;
use Constants\TBS;
class CommonLogic extends BasicLogic
{
    public static function getConfig($sign) {
        $cacheKey = SiteConst::CACHE_SYSTEM_CONFIG;
        $configs = cache($cacheKey);
        if (!$configs || empty($configs)) {
            $configs = AdminLogic::allConfig();
            foreach ($configs as $sign=>$config) {
                AdminLogic::updateCacheConfig($sign, $config);
            }
        }
        return isset($configs[$sign]) ? $configs[$sign] : [];
    }
    
    /**
     * 数据版本,每缓存一次最小版本号+1，如平台版本是V2.0.15，当前数据版本是V1.0.13，那缓存一次会变成V2.0.14
     * @param string $cache 是否是保存
     */
    public static function dataVersion($cache = true) {
        $dataVersion = cache(SiteConst::CACHE_DATA_VERSION);
        $dataVersion = $dataVersion ? $dataVersion : SiteConst::DEFAULT_VERSION;
        if ($cache === true) {
            $config = self::getConfig('version');
            $plateVersion = isset($config['plate']) ? $config['plate'] : SiteConst::DEFAULT_VERSION;;
            $explode = explode('.', $dataVersion);
            $verNumber = end($explode)+1;
            $sub = substr($plateVersion, 0,strrpos($plateVersion,'.')+1);
            $dataVersion = $sub.$verNumber;
            
            cache(SiteConst::CACHE_DATA_VERSION ,$dataVersion);
        }
        return $dataVersion;
    }
    
    /**
     * 获取资源列表，【其实就是查图片】,这个一般是给后台编辑用的
     * @param string $sign 标识
     * @param string $field 字段，就是后台添加时填写的 
     */
    public static function findResourceList($sign, $field) {
        if(!$sign || !$field){
            return [];
        }
        $images = \think\Db::table(TBS::FILE_RESOURCE)
            ->where(['sign'=>$sign,'field'=>$field])
            ->field('fid,filekey,sign,field')
            ->order('id asc')
            ->select();
        return (!empty($images) && $images) ? $images : [];
    }
    
    public static function resourceList($sign, $field) {
        $list = self::findResourceList($sign, $field);
        $temp = [];
        foreach ($list as $file) {
          //  $temp[] = Qiniu::getDomain().$file['filekey'];
            $temp[] = $file['filekey'];
        }
        return $temp;
    }
    
    /**
     * 查询图片，只返回文件访问key,没有的时候返回配置的默认图片key
     * @param string $sign 标识
     * @param string $field 字段，就是后台添加时填写的
     * @param boolean $isArray 是否返回数组，默认直接返回key,为true时返回数组['key1','key2'...]
     * @return Ambigous <multitype:unknown , mixed, boolean, NULL, void, multitype:>
     */
    public static function findResource($sign, $field ,$isArray = false) {

        $iamges = self::findResourceList($sign, $field);
        ///web_host
        $domain =config('web_host');// Qiniu::getDomain();

        if($isArray === false){
            $imgUrl =  isset($iamges['0']) && $iamges['0']['filekey'] ? $domain.$iamges['0']['filekey'] : $domain.config('resourceDefault');
        }else{
            $imgUrl = [];
            foreach ($iamges as $img) {
                $imgUrl[] = $domain.$img['filekey'];
            }
        }
        return $imgUrl;
    }
    
    public static function codeno() {
        $today = date('Ymd');
        $num = \think\Cache::inc('box_sortno_'.$today);
        return mt_rand(1000, 9999).str_pad($num, 4,'0',STR_PAD_LEFT);
    }
}