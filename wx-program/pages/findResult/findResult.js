const app = getApp();
const util = require('../../utils/util.js');
Page({
  data: {
    screenHeight: 500,
    // tabItem: ['全部', '可提货', '已提货', '暂不提货'],
    current: 0,
    orderList: [],
    // statusTitle: { 1: '未支付', 2: '待发货', 3: '已发货', 4: '待提货', 5: '已完成' }
  },

  onLoad: function (options) {
    var searchValue = app.globalData.searchValue ;
    util.post('grouperSearch', {code: searchValue }, (res) => {
      if (res.state==0){
        wx.showToast({
          title: '未找到订单',
          icon: 'loading',
          duration: 1000,
        })
        this.setData({
          orderList: [],
        });
        return false;
      }else{
        var orderList = res.ztreturn;
        this.setData({
          orderList: orderList,
        });
        return true;
      }
     

    });
  },
  sureRecieve: function (e) {
    var inc = e.currentTarget.dataset.inc;
    var order = this.data.orderList[inc];
   
    wx.showModal({
      title: '温馨提示',
      content: '请确认该订单客户已收到货物',
      confirmText: "确定",
      confirmColor: "#0D9D8D",
      success: res => {
        if (res.confirm == 1) {
          util.post("userRecieve", { orderid: order.order.id }, res => {
            this.onLoad();
          });
        }
      }
    });
  },
  ztRecieve: function (e) {
    var inc = e.currentTarget.dataset.inc;
    var order = this.data.orderList[inc];
    wx.showModal({
      title: '温馨提示',
      content: '请确认该订单已到自提点',
      confirmText: "确定",
      confirmColor: "#0D9D8D",
      success: res => {
        if (res.confirm == 1) {
          util.post("ztRecieve", { orderid: order.order.id }, res => {

            util.tip('保存成功');

            this.onLoad();
          });
        }
      }
    });
  },



})