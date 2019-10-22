// pages/about/about.js
Page({

    /**
     * 页面的初始数据
     */
    data: {

    },

    //拨打电话
    telNum: function() {
        wx.makePhoneCall({
            phoneNumber: '15367309666',
        })
    },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function(options) {

    }
})