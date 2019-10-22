const app = getApp();
const util = require('../../utils/util.js');
Page({
    data: {
        grouper: {},
        modelStatus: 1
    },
    onLoad: function(options) {
        app.getAddress(addr => {
            this.setData({
                grouper: addr
            });
        });
    },
    //我的订单跳转
    toggleMaster:function(e) {
      wx.navigateTo({
        url: '../addr/addr'
      })
    }
})

