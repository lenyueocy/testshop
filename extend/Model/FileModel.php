<?php
namespace Model;

use Constants\TBS;
class FileModel extends BasicModel
{
    protected $table = TBS::FILE_RESOURCE;
    
    public function deleteUpload($sign,$field) {
        return $this->getTb()
            ->where([
                'sign'=>$sign,
                'field'=>$field
            ])
            ->delete();
    }
    
    public function addUpload($add) {
        return $this->getTb()->insertAll($add);
    }
    
    public function findResource($sign,$field) {
        return $this->init()
            ->where([
                'sign'=>$sign,
                'field'=>$field
            ])->result('select');
    }
}