const app = getApp();
const util = require('../../utils/util.js');
var countDown = " "
var value = '';
Page({
    data: {
        statusTitle: { 1: '未支付', 2: '待发货', 3: '已发货', 4: '待自提', 5: '已完成' },
    },
    onLoad: function(options) {
      var that = this;
        var order = app.globalData.orderDetail;
        // console.log(order);
        if (!order) {
            util.tip('不存在的订单');
            setTimeout(function() {
                wx.switchTab({
                    url: '/pages/index/index'
                });
            }, 1500);
        }
      console.log(order.order.addtime);
      if (order.order.status == 1) {
        var time = order.order.addtime;
        var date = time.substr(0, 10);
        var hour = time.substr(11, 2) == '00' ? 0 : time.substr(11, 2).replace(/\b(0+)/gi, "");
        var minute = time.substr(14, 2) == '00' ? 0 : time.substr(14, 2).replace(/\b(0+)/gi, "");
        var second = time.substr(17, 2) == '00' ? 0 : time.substr(17, 2).replace(/\b(0+)/gi, "");
        var timestamp = parseInt(new Date(date).getTime()/1000) + parseInt(hour) * 3600 + parseInt(minute) * 60 + parseInt(second) - 28800//别问我为什么-28800，只能告诉你实践出真知 
        var d2 = timestamp; 
        // console.log(d2);            
        // var time = timestampFormat(timestamp) //timestampFormat：自定义的将时间戳转换为刚刚，昨天16:42等表达的方法
        var d1 = parseInt(Date.now() /1000);
        // console.log(d1);

        var down = parseInt((d1 - d2));
        console.log(down);
        var mm = 29 - parseInt(down / 60);
        var ss = 60 - (down - parseInt(down / 60) * 60);
        console.log(mm, ss)
        var interval = setInterval(function () {
          that.setData({
            mm:mm,
            ss:ss
          });
          ss--; 
          if (ss < 0) {
            ss = 59;
            mm -= 1;
          }
          if(mm < 0){
            that.setData({
              mm: 0,
              ss: 0
            });
            clearInterval(interval);
          }
          //console.log(mm, ss)
        }, 1000);
      }

        this.setData(order);
        app.getAddress(addr => {
            this.setData({
                address: addr
            });
        })
    },

  formatDateTime: function (date) {
    var y = date.getFullYear();
    var m = date.getMonth() + 1;
    m = m < 10 ? ('0' + m) : m;
    var d = date.getDate();
    d = d < 10 ? ('0' + d) : d;
    var h = date.getHours();
    var minute = date.getMinutes();
    minute = minute < 10 ? ('0' + minute) : minute;
    var second = date.getSeconds();
    countDown = y + '-' + m + '-' + d + ' ' + h + ':' + minute + ':' + second;
  },

    //拨打团长电话
    callPhone: function(e) {
        wx.makePhoneCall({
            phoneNumber: e.currentTarget.dataset.tel,
        })
    },

    orderPay: function(e) {
        var order = this.data.order;
        util.post('goodsPay', { orderid: order.id }, res => {
            res.success = () => {
                util.tip('支付成功');
                order.status = 2;
                this.setData({
                    order: order
                })
            }
            wx.requestPayment(res);
        });
    },
    sureRecieve: function(e) {
        var order = this.data.order;
        wx.showModal({
            title: '请确认该订单已收货',
            success: res => {
                if (res.confirm == 1) {
                    util.post('userRecieve', { orderid: order.id }, (res) => {
                        order.status = 5;
                        this.setData({
                            order: order
                        })
                    });
                }
            }
        })

    },
  applyDrawback: function (e) {
    var order = this.data.order;
    if (order.status == 2 ) {
      wx.showModal({
        title: '温馨提示',
        content: '确定要申请退款么？',
        success: res => {
          if (res.confirm == 1) {
            util.post('userCancel', { orderid: order.id }, (res) => {
              if (res.state == 1) {
                util.tip('退款成功');
                order.status = -1;
                this.setData({
                  order: order
                })
              } else {
                wx.showModal({
                  content: res.msg,
                  showCancel: false,
                  confirmText: "确定",
                  confirmColor: "#0D9D8D",
                  success: function (res) {
                  }
                })
              }
            });
          }
        }
      })
    } else {
      wx.showModal({
        title: '订单已完成,是否拨打退款电话？',
        content: '客服电话：' + app.globalData.basicData.mobile,
        confirmColor: "#0D9D8D",
        confirmText: "确定",
        success: function (res) {
          if (res.confirm == 1) {
            // console.log("111")
            //拨打客服电话
            wx.makePhoneCall({
              phoneNumber: app.globalData.basicData.mobile,
            })
          }
        }
      })
    }
  },
  cancelOrder:function(e){
    var order = this.data.order;
    wx.showModal({
      title: '温馨提示',
      content: '商品很快要卖完啦，确定要取消么？',
      success: res => {
        if (res.confirm == 1) {
          util.post('userCancel', { orderid: order.id }, (res) => {
            if(res.state==1){
              util.tip('取消成功');
              order.status = -1;
              this.setData({
                order: order
              })
            }else{
              wx.showModal({
                content: res.msg,
                showCancel: false,
                confirmText: "确定",
                confirmColor: "#0D9D8D",
                success: function (res) {
                  
                }
              })
            }
           
          });
        }
      }
    })
  },
  delOrder: function() {
      var order = this.data.order;   
      wx.showModal({
          title: '确定要删除该订单吗？',
          success: res => {
              if (res.confirm == 1) {
                  util.post("orderDel", { orderid: order.id }, res => {
                      wx.navigateBack({
                          delta: 1
                      });
                  });
              }
          }
      })
  },


  

})