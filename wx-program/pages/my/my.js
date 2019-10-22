const allStatus = '1,2,3,4,5';
const app = getApp();
const util = require('../../utils/util');

Page({
    data: {
        userInfo: {},
        showModal: false,
        myCode:'',
        myTotal:'',
      tabItem: ['全部', '待付款', '待发货', '已发货', '待自提', '已完成'],
      current: 0,
      orderList: [],
      orderNum:[],
      statusTitle: { 1: '未支付', 2: '待发货', 3: '已发货', 4: '待自提', 5: '已完成' }
     
    },
    onLoad: function(options) {
      this.getOrderList();
      app.getUser(userInfo => {
            this.setData({
                userInfo: userInfo,
            });
        });
        util.post('Total', {}, res => {
           
         if(res !== ""){
             this.setData({
             myTotal:res.total,
                })
            }else {
             this.setData({
                 myTotal:0,
             })
         }
        });
    },


  onShow: function () {
    this.getOrderList();
    app.getUser(userInfo => {
      this.setData({
        userInfo: userInfo,
      });
    });
    app.getCartList(res => {
      app.setCartList(res);
    });

    util.post('searchLists', {}, (res) => {
     
      this.setData({
        goodsList: res
      });
    })
    util.post('Total', {}, res => {
 
      if (res !== "") {
        this.setData({
          myTotal: res.total,
        })
      } else {
        this.setData({
          myTotal: 0,
        })
      }
    });
  },
    getOrderList: function () {
      var orderList = [[], [], [], [], [], [], []];
      util.post('orderList', { status: allStatus }, res => {
    
        orderList[0] = res;
        for (var key in res) {
          orderList[1] = orderList[1] || [];
          orderList[2] = orderList[2] || [];
          orderList[3] = orderList[3] || [];
          orderList[4] = orderList[4] || [];
          orderList[5] = orderList[5] || [];
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
            default:
              orderList[5].push(res[key]);
              break;
          }
        }
     
        var orderNum = [];
        for (var i = 0; i < orderList.length; i++) {
          orderNum.push(orderList[i].length)

        }
    
        this.setData({
          orderNum: orderNum,
        });
      });
    },
    
    //我的订单跳转
    targetOrder:function(e){
      var inc = e.currentTarget.dataset.inc;
      app.globalData.inc = inc;
      var url = "../order/order"
      wx.switchTab({
        url: url,
        //回跳页面成功重新渲染页面
        success: function (e) {
          var page = getCurrentPages().pop();
          if (page == undefined || page == null)
            return;
          page.onLoad();
        }
      })

    },




    saleServer: function() {
      wx.showLoading({
        title: '正在加载'
      });
      util.post('myCode', {}, res => {
        wx.hideLoading();
        var code = [];
        for(var i=0;i<res.code.length;i++){
          code.push(res.code[i]);
        }
        this.setData({
          myCode:code,
          showModal: true
        })
      });
    
    },

  go: function () {
    this.setData({
      showModal: false
    })
  },

});