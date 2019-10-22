const util = require('../../utils/util.js');
const app = getApp();
var flag = true;
Page({
    data: {
        cartList: [],
        totalPrice: 0,
        isSelectAll: 1,
        ifDelecte:true,
        carnum: 0,
    },
    //管理
    manage:function(){
      this.setData({
        ifDelecte: true
      })
    },

    //去结算
    toConfirm: function() {
        var cartList = this.data.cartList;
        var addCartid = [];
        for (var key in cartList) {
            if (cartList[key].select != 2) {
                addCartid.push(cartList[key].info.id);
            }
        }
        if (addCartid.length < 1) {
            util.tip('请选择商品');
            return false;
        }
        util.post('addTempOrder', { cart: addCartid.join(','), type: 1 }, (res) => {
          if (flag) {
            wx.navigateTo({
              url: '/pages/confirm/confirm?tempid=' + res.tempid
            })
            flag = !flag;
            // console.log(flag);
            setTimeout(function(){
              flag = !flag;
          // console.log(flag);
          },3000);
        }
        });
    },

    /**
     * 生命周期函数--监听页面显示
     */
    onShow: function() {
        util.post('cartList', {}, (res) => {
            this.countCart(res);
            app.setCartList(res);
            this.setData({
                carnum: app.globalData.bags
            })
           
        });
    },
    countCart: function(cartList) {
        var totalPrice = 0;
        var isSelectAll = 1;
        for (var key in cartList) {
            if (!cartList[key].select) {
                cartList[key].select = 1;
            }
            if (cartList[key].select == 1) {
                totalPrice += cartList[key].info.num * cartList[key].goods.price;
            } else {
                isSelectAll = 2;
            }
        }
        this.setData({
            cartList: cartList,
            totalPrice: totalPrice.toFixed(2),
            isSelectAll: isSelectAll
        });
    },

    changeSelect: function(e) {
        var cartList = this.data.cartList;
        var inc = e.currentTarget.dataset.inc;
        cartList[inc].select = cartList[inc].select == 1 ? 2 : 1;
        this.countCart(cartList);
    },
    changeSelectAll: function() {
        var selected = this.data.isSelectAll == 1 ? 2 : 1;
        var cartList = this.data.cartList;
        for (var key in cartList) {
            cartList[key].select = selected;
        }
        this.countCart(cartList);
    },

    changeNum: function(e) {
        var data = e.currentTarget.dataset;
        var cartList = this.data.cartList;
        if (data.type == 1 && cartList[data.inc].info.num <= 1) {
            return true;
        }
        cartList[data.inc].info.num = data.type == 1 ? parseInt(cartList[data.inc].info.num) - 1 : parseInt(cartList[data.inc].info.num) + 1
        util.post('cartEdit', { cartid: cartList[data.inc].info.id, num: cartList[data.inc].info.num }, (res) => {
            this.countCart(cartList);
            app.setCartList(cartList);
          this.setData({
            carnum: app.globalData.bags
          })
        });
    },


    //删除
    delete:function(){
      var cartList = this.data.cartList;
      var addCartid = [];
      var newlist = [];
      for (var key in cartList) {
        if (cartList[key].select != 2) {
          addCartid.push(cartList[key].info.id);
        }else{
          newlist.push(cartList[key]);
        }
      }
    
      if (addCartid.length < 1) {
        util.tip('请选择商品');
        return false;
      }
        wx.showModal({
          title: '确定要删除该商品吗？',
          content: '请谨慎操作，以免找不到哦',
          success: (res) => {
            if (res.confirm) {
              util.post('cartDel', { cartid: addCartid.join(',') }, (res) => {
                this.countCart(newlist);
                app.setCartList(newlist);
                this.setData({
                  carnum: app.globalData.bags
                })
              });
            }
          }
        })
 

    },

    //删除商品
    delCart: function(e) {
        var inc = e.currentTarget.dataset.inc;
        var cartList = this.data.cartList;
        wx.showModal({
            title: '确定要删除该商品吗？',
          content: '请谨慎操作，以免找不到哦',
            success: (res) => {
                if (res.confirm) {
                
                    util.post('cartDel', { cartid: cartList[inc].info.id }, (res) => {
                        cartList.splice(inc, 1);
                        this.countCart(cartList);
                        app.setCartList(cartList);
                        this.setData({
                          carnum: app.globalData.bags
                        })
                    });
                }
            }
        })
    }
})