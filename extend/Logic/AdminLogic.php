<?php
namespace Logic;

use Constants\SiteConst;
use Model\ConfigModel;
use Model\FileModel;

class AdminLogic extends BasicLogic
{
    public static function updateConfig($dataArray) {
        if ($dataArray['sign'] != 'game') {
            $model = new ConfigModel();
            $config = [];
            foreach ($dataArray as $key=>$params) {
                if ($key == 'sign') {
                    continue;
                }
                $model->updateConfig($dataArray['sign'], $key, $params);
                if (!isset($config[$key])) {
                    $config[$key] = $params;
                }
            }
            return self::updateCacheConfig($dataArray['sign'], $config);
        }else{
            return self::gameFile($dataArray);
        }
    }
    
    public static function gameFile($data) {
        $dataStr = var_export($data['game'],true);
        $str = <<<EOF
<?php
return $dataStr;
EOF;
        $file = CONF_PATH.'game.php';
        file_put_contents($file, $str);
        return true;
    }
    
    public static function updateCacheConfig($sign,$config) {
        $cacheKey = SiteConst::CACHE_SYSTEM_CONFIG;
        $configs = cache($cacheKey);
        $configs = $configs ? $configs : [];
        $configs[$sign] = $config;
        return cache($cacheKey,$configs);
    }
    
    public static function getConfig($sign) {
        $cacheKey = SiteConst::CACHE_SYSTEM_CONFIG;
        $configs = cache($cacheKey);
        if (!$configs || empty($configs)) {
            $configs = self::allConfig();
            foreach ($configs as $sign=>$config) {
                self::updateCacheConfig($sign, $config);
            }
        }
        return isset($configs[$sign]) ? $configs[$sign] : [];
    }
    
    public static function allConfig() {
        $model = new ConfigModel();
        $config = $model->selectAll();
        $items = [];
        foreach ($config as $item) {
            if (!isset($items[$item['sign']])) {
                $items[$item['sign']]= [];
            }
            $items[$item['sign']][$item['key']] = $item['params'];
        }
        return $items;
    }
    
    public static function fileUpload($sign,$field,$fileArr) {
        $add = [];
        foreach ($fileArr as $key=>$file) {
            $add[] = [
                'fid'=>$file['id'],
                'filekey'=>$file['key'],
                'sign'=>$sign,
                'field'=>$field,
            ];
        }
        $model = new FileModel();
        $model->deleteUpload($sign, $field);
        if (!empty($add)) {
            return $model->addUpload($add);
        }
        return true;
        
    }
}