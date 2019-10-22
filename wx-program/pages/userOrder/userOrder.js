const allStatus = '2, 3, 4, 5';
const util = require('../../utils/util.js');
const app = getApp();
Page({
    data: {
        screenHeight: 500,
      tabItem: ['全部', '可提货', '已提货', '暂不提货'],
        current: 0,
        pagenum:1,
        orderList: [],
      statusTitle: { 1: '未支付', 2: '待发货', 3: '已发货', 4: '待提货', 5: '已完成' },
        status:''
    },
    onLoad: function(options) {
        var info = wx.getSystemInfoSync();
        this.setData({
            screenHeight: info.windowHeight - 50,
        });
        this.getOrderList();
    },

    getOrderList: function() {
        var orderList = [[],[],[],[]];
        console.log(allStatus);
        let current = this.data.current;
       if (current==0) {
          var status= '2, 3, 4, 5';
           this.setData({
               status: status,
           });
       }else if(current==1){
           var status='4';
           this.setData({
               status: status,
           });
       }else if(current==2){
           var status= '5';
           this.setData({
               status: status,
           });
       }else if(current==3){
           var status='2,3';
           this.setData({
               status: status,
           });
       }

        util.post('grouperOrder', { status: status,'num':10 }, res => {
            console.log(res);
            orderList[0] = res;
            for (var key in res) {
              // console.log(parseInt(res[key].order.status))
                orderList[1] = orderList[1] || [];
                orderList[2] = orderList[2] || [];
                orderList[3] = orderList[3] || [];
                switch (parseInt(res[key].order.status)) {
                    case 1:
                        // orderList[0].push(res[key]);
                        break;
                    case 2:
                        orderList[3].push(res[key]);
                        break;
                    case 3:
                        orderList[3].push(res[key]);
                        break;
                  case 4:
                    orderList[1].push(res[key]);
                    break;
                  case 5:
                    orderList[2].push(res[key]);
                    break;
                    default:
                        orderList[3].push(res[key]);
                        break;
                }
                // console.log(orderList);
            }

            this.setData({
                orderList: orderList,
            });

        });
    },

    onReachBottom: function () {
        var orderList = this.data.orderList;
        var num =10;

        if (orderList.length>0){
            var p = this.data.pagenum;
            p++;
            let current = this.data.current;
            if (current==0) {
                var status= '2, 3, 4, 5';
                this.setData({
                    status: status,
                });
            }else if(current==1){
                var status='4';
                this.setData({
                    status: status,
                });
            }else if(current==2){
                var status= '5';
                this.setData({
                    status: status,
                });
            }else if(current==3){
                var status='2,3';
                this.setData({
                    status: status,
                });
            }
            util.post('grouperOrder', {status: status ,'p':p,'num':10}, (res) => {

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

                        switch (parseInt(res[key].order.status)) {
                            case 1: //待付款
                               // orderList[1].push(res[key]);
                                break;
                            case 2: //待发货
                                orderList[3].push(res[key]);
                                break;
                            case 3: //已发货
                                orderList[3].push(res[key]);
                                break;
                            case 4: //待自提
                                orderList[1].push(res[key]);
                                break;
                            case 5: //已完成
                                orderList[2].push(res[key]);
                                break;
                            default: //退款售后
                                orderList[3].push(res[key]);
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
                        console.log('------1---');
                        console.log(sumlight);

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
    tabTitleClick: function(e) {
        var inc = e.currentTarget.dataset.inc;
        this.setData({
            current: inc,
            pagenum:1
        })
        this.onLoad();
    },
    changeTab: function(e) {
        if (e.detail.source == 'touch') {
            this.setData({
                current: e.detail.current
            });
        }
    },
    sureRecieve: function(e) {
        var inc = e.currentTarget.dataset.inc;
        var order = this.data.orderList[this.data.current][inc];
        wx.showModal({
          title: '温馨提示',
          content: '请确认该订单客户已收到货物',
          confirmText: "确定",
          confirmColor: "#0D9D8D",
          success: res => {
              if (res.confirm == 1) {
                  util.post("userRecieve", { orderid: order.order.id }, res => {
                    var orderList = [[], [], [], []];
                    util.post('grouperOrder', { status: allStatus }, res => {
                      orderList[0] = res;
                      for (var key in res) {
                        // console.log(parseInt(res[key].order.status))
                        orderList[1] = orderList[1] || [];
                        orderList[2] = orderList[2] || [];
                        orderList[3] = orderList[3] || [];
                        switch (parseInt(res[key].order.status)) {
                          case 1:
                            // orderList[0].push(res[key]);
                            break;
                          case 2:
                            orderList[3].push(res[key]);
                            break;
                          case 3:
                            orderList[3].push(res[key]);
                            break;
                          case 4:
                            orderList[1].push(res[key]);
                            break;
                          case 5:
                            orderList[2].push(res[key]);
                            break;
                          default:
                            orderList[5].push(res[key]);
                            break;
                        }
                        // console.log(orderList);
                      }
                      this.setData({
                        orderList: orderList,
                      });
                    });
                  });
              }
          }
        });
    },
  ztRecieve: function (e) {
    var inc = e.currentTarget.dataset.inc;
    var order = this.data.orderList[this.data.current][inc];
    wx.showModal({
      title: '温馨提示',
      content: '请确认该订单已到自提点',
      confirmText: "确定",
      confirmColor: "#0D9D8D",
      success: res => {
        if (res.confirm == 1) {
          util.post("ztRecieve", { orderid: order.order.id }, res => {
           
              util.tip('确认成功');
              var orderList = [[], [], [], []];
              util.post('grouperOrder', { status: allStatus }, res => {
                orderList[0] = res;
                for (var key in res) {
                  // console.log(parseInt(res[key].order.status))
                  orderList[1] = orderList[1] || [];
                  orderList[2] = orderList[2] || [];
                  orderList[3] = orderList[3] || [];
                  switch (parseInt(res[key].order.status)) {
                    case 1:
                      // orderList[0].push(res[key]);
                      break;
                    case 2:
                      orderList[3].push(res[key]);
                      break;
                    case 3:
                      orderList[3].push(res[key]);
                      break;
                    case 4:
                      orderList[1].push(res[key]);
                      break;
                    case 5:
                      orderList[2].push(res[key]);
                      break;
                    default:
                      orderList[5].push(res[key]);
                      break;
                  }
                  // console.log(orderList);
                }
                this.setData({
                  orderList: orderList,
                });
              });
          });
        }
      }
    });
  },
})