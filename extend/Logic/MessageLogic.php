<?php
namespace Logic;

use think\Exception;
use Common\Data;
use Model\MessageModel;
use Model\MessageGoodsModel;
use Model\UserMessageModel;
use Constants\SiteConst;
use Logic\Goods\AddGoodsLogic;
use Model\UserModel;

class MessageLogic extends BasicLogic
{

    public static function addMessage($type)
    {
        if (! Data::instance()->title || ! Data::instance()->content) {
            self::error(10001);
        }
        if (! Data::instance()->toUsers || empty(Data::instance()->toUsers)) {
            self::error(50001);
        }
        if ($type == 2 && Data::instance()->guds) {
            self::error(10005);
        }
        $msgMod = new MessageModel();
        $msgGoodsMod = new MessageGoodsModel();
        $userMsgMod = new UserMessageModel();
        try {
            self::startTrans();
            $fromid = $type == 1 ? 0 : Data::$user['id'];
            $msg = $msgMod->addMessage(Data::instance()->title, Data::instance()->title, $fromid, $type);
            if ($type == 1) {
                $msgGoodsMod->addGoods($msg['id'], Data::instance()->guds);
            }
            $userMsgMod->addUsers($msg['id'], Data::instance()->toUsers, Data::instance()->guds && ! empty(Data::instance()->guds));
            self::commit();
        } catch (Exception $e) {
            self::rollback();
            throw $e;
        }
        return true;
    }

    public static function listMessage()
    {
        $messageMod = new MessageModel();
        $list = $messageMod->selectList();
        $userMsgMod = new UserMessageModel();
        $userMsg = $userMsgMod->userMessage(Data::$user['id']);
        
        
        foreach ($list as $key=>$msg) {
            $msg['timeStr'] = date('Y年m月d日H:i',strtotime($msg['addtime']));
            $msg['isRead'] = in_array($msg['id'], $userMsg) ? 1 : 2;
            $list[$key] = $msg;
        }
        return $list; 
    }
    
    public static function delMessage() {
        if (!Data::instance()->msgid) {
            self::error(10001);
        }
        $userMsgMod = new UserMessageModel();
        $msg = $userMsgMod->findByMsgid(Data::$user['id'], Data::instance()->msgid);
        if (!$msg) {
            self::error(60001);
        }
        if ($msg['isreceive'] == SiteConst::NO_VALUE) {
            self::error(60002);
        }
        return $userMsgMod->setDel($msg['id']);
    }
    
    public static function receiveMessage() {
        if (!Data::instance()->msgid) {
            self::error(10001);
        }
        $userMsgMod = new UserMessageModel();
        $msg = $userMsgMod->findByMsgid(Data::$user['id'], Data::instance()->msgid);
        if (!$msg) {
            self::error(60001);
        }
        if ($msg['isreceive'] == SiteConst::YES_VALUE) {
            self::error(60003);
        }
        $msgGoodsMod = new MessageGoodsModel();
        $msgGoods = $msgGoodsMod->selectForReceive(Data::instance()->msgid);
        if (empty($msgGoods)) {
            self::error(60004);
        }
        try {
            self::startTrans();
            foreach ($msgGoods as $goods) {
                AddGoodsLogic::init($goods, $goods['sendNum'])->run();
            }
            $userMsgMod->setReceive($msg['id']);
            self::commit();
        } catch (Exception $e) {
            self::rollback();
            throw $e;
        }
        $userMod = new UserModel();
        return $userMod->userInfo(Data::$user);
    }
    
    public static function readMessage() {
        if (!Data::instance()->msgid) {
            self::error(10001);
        }
        $userMsgMod = new UserMessageModel();
        return $userMsgMod->setRead(Data::$user['id'], Data::instance()->msgid);
    }
}