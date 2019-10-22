
//const BASE_URL = 'http://192.168.2.91:8000/api.php/';


//const BASE_URL = 'https://mprogram.jetsum.com/api.php/';
const BASE_URL = 'https://yhgc555.vip/api.php/';
const URI = {
    'getBasic': 'system/getbasic',
    'grouperInfo': 'ucenter/grouper',
    'UserInfo':'ucenter/getUser',
    'setArea':'ucenter/editFrom',//切换团长信息
    'codeLogin': 'ucenter/login',
    'register': 'ucenter/register',
    'setFrom': 'ucenter/from',
    'myCode': 'ucenter/code',//获取取货码
    'myTotal': 'ucenter/total',
    'Total': 'ucenter/newTotal',
    'getphone': 'ucenter/getphone',
    'user': 'ucenter/edit',
    'goodsList': "goods/lists",
    'searchGoods':'goods/goods',//首页和搜索商品以及加载更多
    'searchLists':'goods/goodsLists',//首页和搜索商品以及加载更多
    'buyRecord': 'goods/record',//获取购买商品会员信息
    'goodsOrder':'goods/order',
    'goodsCategory': 'goods/category',
    'goodsDetail': 'goods/detail',//商品详细
  
    'goodsQrcode': 'goods/qrcode',//商品二维码
  
    'addCart': 'cart/add',
    'cartList': 'cart/lists',
    'cartEdit': 'cart/edit',
    'cartDel': 'cart/del', //购物车删除商品

    'addTempOrder': 'order/temp',
    'confirmInfo': 'order/confirm',
    'orderAdd': 'order/add',
    'orderList': 'order/myorder',
    'searchOrderLists': 'order/searchorder',
  
    'userRecieve': 'order/recieve',
    'userCancel': 'order/cancel',//取消订单 /申请退款
  
    'ztRecieve': 'order/ztrecieve',
    'orderDel': 'order/del',

    'goodsPay': 'payment/goods',

    'grouperCount': 'grouper/info',
    'grouperOrder': 'grouper/order',
  'grouperOrderTest': 'grouper/orderTest',
    'grouperSearch': 'grouper/search',//根据提货码搜索订单
    'grouperAccount': 'grouper/account',
    'grouperCommission': 'grouper/commission',
    'grouperEdit': 'grouper/edit',
    'grouperQrCode': 'grouper/qrcode',//二维码

    'noticeList': 'message/notice',//团长通知公告列表
    'readMsg':'message/read',
 
    'swiper': 'content/swiper',
    'areaList':'ucenter/get_area',//获取可用的团长信息列表

    'closeTime':'ucenter/closeTime'

};

const getUrl = type => {
    return BASE_URL + URI[type];
}

module.exports = {
    getUrl: getUrl
}