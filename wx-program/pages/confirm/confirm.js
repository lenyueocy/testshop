// pages/confirm/confirm.js
var tempid = 0;
const util = require('../../utils/util.js');
const app = getApp();
var orderid = 0;
Page({

    /**
     * 页面的初始数据
     */
    data: {
        address: [],
        goodsList: [],
        price: 0,
        realprice: 0,
        cash: 0,
        downpoint: 0,
        name: '',
        areatext: '订单备注...',
      　areaHeight: 'margin-bottom: 90rpx;',
      　multiShow: true,
      　u_remark: ""
    },

  inputchange:function(e){
    this.setData({
      areatext: ' ',
    })
  },

    //提交订单
    formSubmit: function(e) {
        if (orderid) {
            this.wxPay();
            return true;
        }
        var formData = e.detail.value;
        if (!formData.name) {
            util.tip('请输入您的姓名');
            return false;
        }
        if (!formData.mobile) {
            util.tip('请输入手机号');
            return false;
        }
        if (!/(^1\d{10}$)/.test(formData.mobile)) {
            util.tip('手机号格式错误');
            return false;
        }
        formData.tempid = tempid;
      if (this.data.address.status==2){
          wx.showModal({
            content: '此小区已被禁用，请更换团长',
            showCancel: false,
            confirmText: "确定",
            confirmColor: "#0D9D8D",
            success: function (res) {
              if (res.confirm) {
                wx.navigateBack({ changed: true });//返回上一页
              }
            }
          })
            return false;
        }
        wx.showModal({
            title: '此商品需自提，请确认收货地址！',
            content: '小区名称：' + this.data.address.title + '；提货地址：' + this.data.address.address + ' ' + this.data.address.ext,
            success: (res) => {
                if (res.confirm) {
                    util.post('orderAdd', formData, res => {
                      if (res.state==1){
                        orderid = res.orderid;
                        this.wxPay();
                      }else{

                        wx.showModal({
                          content: res.msg,
                          showCancel: false,
                          confirmText: "确定",
                          confirmColor: "#0D9D8D",
                          success: function (res) {
                            if (res.confirm) {
                              wx.navigateBack({ changed: true });//返回上一页
                            }
                          }
                        })

                       
                       return true;
                      }
                        
                    });
                }
            }
        })

    },
    wxPay: function() {
        util.post('goodsPay', { orderid: orderid }, payData => {
            payData.success = function() {
                util.tip('支付成功');
                setTimeout(function() {
                  wx.switchTab({
                        url: '/pages/order/order'
                    });
                }, 1500);
            }
            payData.fail = function(res) {
              wx.showToast({
                title: '支付失败！',
                icon:'loading',
                duration: 2000
              })
              setTimeout(function () {
                wx.switchTab({
                  url: '/pages/order/order'
                });
              }, 1500);
              
              return true;
            }
         
            wx.requestPayment(payData);
        });
    },
    onShow: function() {
        orderid = 0;
    },
  // changeMul:function(){
  //   this.setData({
  //     multiShow: false
  //   })
  // },
    onLoad: function(options) {
        this.setData({
          multiShow: false
        })
        if (!options.tempid) {
            wx.switchTab({
                url: '/pages/index/index'
            });
            return true;
        }
        tempid = options.tempid;
        util.post('confirmInfo', { tempid: tempid }, res => {
          console.log(res);
            this.setData(res);
        });

        app.getAddress(res => {
          
            this.setData({
                address: res,
            });
        });

        app.getUserInfo(res => {
            this.setData({
                name: res.nickname,
                mobile:res.mobile
            })
        })
    },
  ifshowArea(e) {
    　　var t_show = e.currentTarget.dataset.show == "yes" ? true : false;
    　　if (t_show) {//不显示textarea 
      　　　　this.setData({
        　　　　　　areatext: this.data.u_remark ? this.data.u_remark : "订单备注(0/100)",
        　　　　　　areaHeight: 'margin-bottom: 90rpx;'
      　　　　});
      　　　　this.setData({ multiShow: t_show })
    　　} else {//显示textarea 
      　　　　this.setData({
        　　　　　　areaHeight: ' margin-bottom: 250rpx;'
      　　　　});
      　　　　wx.createSelectorQuery().select('.j_page').boundingClientRect((rect) => {
        　　　　　　console.log(rect)
        　　　　　　// 使页面滚动到底部
        　　　　　　wx.pageScrollTo({
          　　　　　　　　scrollTop: rect.bottom
        　　　　　　})
        　　　　　　this.setData({
          　　　　　　　　multiShow: t_show
        　　　　　　})
      　　　　}).exec()
    　　}
  }
})