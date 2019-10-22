<?php
namespace Logic;

use think\Db;
use Common\Error;
class BasicLogic
{
    
    protected static function error($code) {
        return Error::errMsg($code);
    }
    
    protected static function startTrans() {
        return Db::startTrans();
    }
    
    protected static function commit() {
        return Db::commit();
    }
    
    protected static function rollback() {
       return Db::rollback();
    }
}