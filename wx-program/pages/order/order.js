const allStatus = '1, 2, 3, 4, 5';
const util = require('../../utils/util.js');
const app = getApp();
var countDown = " ";
var textDate = [];
var value = "";
Page({

    /**
     * 页面的初始数据
     */
    data: {
      screenHeight: 500,
      ballRight:0,
      pagenum:1,
      tabItem: ['全部', '待付款', '待发货', '已发货', '待自提','退款/售后','已完成'],
      current: 0,
      orderList: [],
      statusTitle: { 1: '未支付', 2: '待发货', 3: '已发货', 4: '待自提', 5: '已完成', 6: '已退款' }
    },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function(options) {
        var info = wx.getSystemInfoSync();
        this.setData({
            screenHeight: info.windowHeight - 50,
        });
        this.getOrderList();

      if (app.globalData.inc){
        this.setData({
          current: app.globalData.inc,
          ballRight:45 * app.globalData.inc
        })
        app.globalData.inc = null;
      }
    },
    onShow: function (options) {
       this.onLoad();
    },
    changeTab: function(e) {
        if (e.detail.source == 'touch') {
            this.setData({
                current: e.detail.current,
                ballRight: 20 * e.detail.current
            });
            console.log(e.detail.current);
         
        }
    },
    tabTitleClick: function(e) {
        var inc = e.currentTarget.dataset.inc;
          console.log(inc)
        // console.log('111111111')
        // console.log(this.data.pagenum)
        this.setData({
            current: inc,
            searchValue:"",
            ballRight: 45 * inc,
            pagenum:1
        })

        console.log(this.data.pagenum)
      this.onLoad();
    },

    getOrderList: function() {
        var that = this;
      var orderList = [[], [], [], [], [], [], []];
      util.post('searchOrderLists', {'keyword':'' ,status: allStatus,'num':10 }, res => {
            orderList[0] = res;
            for (var key in res) {
                orderList[1] = orderList[1] || [];
                orderList[2] = orderList[2] || [];
                orderList[3] = orderList[3] || [];
                orderList[4] = orderList[4] || [];
                orderList[5] = orderList[5] || [];
                orderList[6] = orderList[6] || [];
                switch (parseInt(res[key].order.status)) {
                    case 1: //待付款
                        orderList[1].push(res[key]);
                        break;
                    case 2: //待发货
                        orderList[2].push(res[key]);
                        break;
                  case 3: //已发货
                    orderList[3].push(res[key]);
                    break;
                  case 4: //待自提
                    orderList[4].push(res[key]);
                    break;
                  case 5: //已完成
                    orderList[6].push(res[key]);
                    break;
                    default: //退款售后
                        orderList[5].push(res[key]);
                        break;
                }
            }
          var orderNum = [];
          for(var i=0;i<orderList.length;i++){
            orderNum.push(orderList[i].length)
          }
          
            this.setData({
                textDate:textDate,
                orderList: orderList,
            });
          let _this = this;
       
          //创建节点选择器
          var sum = wx.createSelectorQuery().selectAll('.item-' + this.data.current).boundingClientRect(function (rects) {
              var sumlight=0;
              rects.forEach(function (rect) {
                  sumlight += rect.height // 节点的高度
              })
              _this.setData({
                  screenHeight: sumlight,
              });
            console.log('------1---');
            console.log(sumlight);

          }).exec()
         // console.log(orderList);
        });
    },

    onReachBottom: function () {
        console.log('-------上拉-------------------');
        var orderList = this.data.orderList;
        if (orderList.length>0){
            var p = this.data.pagenum;
            p++;
            util.post('searchOrderLists', { 'keyword': '',status: allStatus ,'p':p,'num':10}, (res) => {
              console.log(res);
                if (res.length == 0) {
                    wx.showToast({
                        title: '没有更多数据了',
                        icon: 'none',
                        duration: 2000
                    })
                } else {
                  for (var key in res) {
                    orderList[0].push(res[key]);
                    orderList[1] = orderList[1] || [];
                    orderList[2] = orderList[2] || [];
                    orderList[3] = orderList[3] || [];
                    orderList[4] = orderList[4] || [];
                    orderList[5] = orderList[5] || [];
                    orderList[6] = orderList[6] || [];
                    switch (parseInt(res[key].order.status)) {
                      case 1: //待付款
                        orderList[1].push(res[key]);
                        break;
                      case 2: //待发货
                        orderList[2].push(res[key]);
                        break;
                      case 3: //已发货
                        orderList[3].push(res[key]);
                        break;
                      case 4: //待自提
                        orderList[4].push(res[key]);
                        break;
                      case 5: //已完成
                        orderList[6].push(res[key]);
                        break;
                      default: //退款售后
                        orderList[5].push(res[key]);
                        break;
                    }
                  }

                    this.setData({
                        orderList: orderList,
                        pagenum:p
                    });
                 
                  if (orderList[this.data.current].length%10!=0){
                  
                      wx.showToast({
                        title: '没有更多数据了',
                        icon: 'none',
                        duration: 2000
                      })
                    }


                    let _this = this;
                 
                    //创建节点选择器
                    var sum = wx.createSelectorQuery().selectAll('.item-' + this.data.current).boundingClientRect(function (rects) {
                        var sumlight=0;
                        rects.forEach(function (rect) {
                            sumlight += rect.height // 节点的高度
                         
                        })
                        _this.setData({
                          screenHeight: sumlight,
                        });
                    

                    }).exec()


                }
            });

            setTimeout(() => {
                this.setData({
                    isHideLoadMore: true,
                })
            }, 1000)
        }
    },

    orderPay: function(e) {
        var inc = e.currentTarget.dataset.inc;
        var order = this.data.orderList[this.data.current][inc];
        util.post('goodsPay', { orderid: order.order.id }, res => {
            res.success = () => {
                util.tip('支付成功');
                this.getOrderList();
            }
            wx.requestPayment(res);
        });
    },
    sureRecieve: function(e) {
        var inc = e.currentTarget.dataset.inc;
        var order = this.data.orderList[this.data.current][inc];
        wx.showModal({
            title: '温馨提示',
            content: '请确认该订单您已收到货物',
            confirmText: "确定",
            confirmColor: "#0D9D8D",
            success: res => {
                if (res.confirm == 1) {
                    util.post("userRecieve", { orderid: order.order.id }, res => {   
                        util.tip('保存成功');
                        this.getOrderList();
                    });
                }
            }
        }); 
    },
  applyDrawback:function(e){
    var inc = e.currentTarget.dataset.inc;
    var order = this.data.orderList[this.data.current][inc];
    // if (order.order.status == 2 || order.order.status == 3 || order.order.status == 4 ){    2: '待发货', 3: '已发货', 4: '待自提', 5: '已完成'
      if (order.order.status == 2 ){ //还未发货前可线上直接退款 ，发货后只支持线下拨打电话退款
      wx.showModal({
        title: '温馨提示',
        content: '确定要申请退款么？',
        confirmText: "确定",
        confirmColor: "#0D9D8D",
        success: res => {
          if (res.confirm == 1) {
            util.post('userCancel', { orderid: order.order.id }, (res) => {
              if (res.state == 1) {
                util.tip('退款成功');
                this.getOrderList();
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
    }else{
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
  cancelOrder: function (e) {
    var inc = e.currentTarget.dataset.inc;
    var order = this.data.orderList[this.data.current][inc];
    wx.showModal({
      title: '温馨提示',
      content: '商品很快就要发货啦，确定要取消么？',
      confirmText: "确定",
      confirmColor: "#0D9D8D",
      success: res => {
        if (res.confirm == 1) {
          util.post('userCancel', { orderid: order.order.id }, (res) => {
            if (res.state == 1) {
              util.tip('取消成功');
              this.getOrderList();
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
  },
  toOrderDetail: function(e) {
      var inc = e.currentTarget.dataset.inc;
      var order = this.data.orderList[this.data.current][inc];
      app.globalData.orderDetail = order;
      wx.navigateTo({
          url: '/pages/orderDetail/orderDetail'
      })
  },
  delOrder: function(e) {
      var inc = e.currentTarget.dataset.inc;
      var order = this.data.orderList[this.data.current][inc];
 
      wx.showModal({
          title: '确定要删除该订单吗？',
          success: res => {
              if (res.confirm == 1) {
                  util.post("orderDel", { orderid: order.order.id }, res => {
                      this.getOrderList();
                  });
              }
          }
      })
  },
  

  ballMoveEvent: function (e) {
    // console.log('我被拖动了....')
    var touchs = e.touches[0];
    var pageX = touchs.pageX;
    // console.log('pageX: ' + pageX);
    if(pageX>200){
      pageX = 0
    }
    this.setData({
      ballRight: pageX
    });
  }, 

  //点击输入框输入文字；
  searchValueInput: function (e) {
    value = e.detail.value;
    this.setData({
      searchValue: value,
      pagenum: 1
    });
  },

  //搜索事件
  bindConfirm: function (e) {
    var orderList = [[],[],[],[],[],[],[]];
    util.post('searchOrderLists', { 'keyword': value,status: allStatus  }, (res) => {
      console.log(res);
      orderList[0] = res;
      for (var key in res) {
        orderList[1] = orderList[1] || [];
        orderList[2] = orderList[2] || [];
        orderList[3] = orderList[3] || [];
        orderList[4] = orderList[4] || [];
        orderList[5] = orderList[5] || [];
        orderList[6] = orderList[6] || [];
        switch (parseInt(res[key].order.status)) {
          case 1:
            orderList[1].push(res[key]);
            break;
          case 2:
            orderList[2].push(res[key]);
            break;
          case 3:
            orderList[3].push(res[key]);
            break;
          case 4:
            orderList[4].push(res[key]);
            break;
          case 5: //已完成
            orderList[6].push(res[key]);
            break;
          default: //退款售后
            orderList[5].push(res[key]);
            break;
        }
      }
      console.log(orderList);
      this.setData({
        orderList: orderList
      });
    });
  },
  ///复制订单号
  copyTBL: function (e) {
    var self = this;

    wx.setClipboardData({
      data: e.target.dataset.taokouling,
      success: function (res) {
        wx.getClipboardData({
          success: function (res) {
            wx.showToast({
              title: '已复制到粘贴板',//提示文字
              duration: 1000,//显示时长

            })

          }
        })
      }
    })

  },


});