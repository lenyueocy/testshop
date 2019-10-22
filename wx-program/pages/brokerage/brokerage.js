// pages/brokerage/brokerage.js
const app = getApp();
const util = require('../../utils/util.js');
Page({

  /**
   * 页面的初始数据
   */
  data: {
    'total': 0,
    'price': 0,
    'withdraw':0,
    
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function () {
    util.post('grouperCommission', { }, res => {
      this.setData({
        total: res.total,
        price: res.price,
        withdraw: res.withdraw
      });
    })

   
    
    
  },
  targetDetail: function () {
      wx.navigateTo({
        url: '/pages/income/income'
      })
   
  },
  cancelOrder: function (e) {
    var order = this.data.order;
    // wx.showModal({
    //   title: '温馨提示',
    //   content: '确定要提现么？',
    //   confirmText: "确定",
    //   confirmColor: "#069185",
    //   success: res => {
    //     if (res.confirm == 1) {
              wx.showModal({
                title: '是否拨打客服电话？',
                content: '客服电话：' + app.globalData.basicData.mobile,
                // showCancel: false,
                confirmText: "确定",
                confirmColor: "#069185",
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
    //         }
    //     }
    // })
    },


  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})