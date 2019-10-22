const app = getApp();
const util = require('../../utils/util.js');
var value;
Page({
    data: {
    
    },

    onLoad: function(options) {
        app.getAddress(group => {
            this.setData({
                group: group
            })
        });
    },
  //点击输入框输入文字；
  searchValueInput: function (e) {
    value = e.detail.value;
    this.setData({
      searchValue: value,
    });

  },

  //搜索事件
  searchCode: function () {
    app.globalData.searchValue = value;
  
    if (isNaN(value) ||value==''||value==undefined|| value<100000||value>999999){
      wx.showToast({
        title: '提货码不合法',
        icon:'loading',
        duration: 1000,
       
      })
      return false;
    }
    wx.navigateTo({
      url: '../findResult/findResult',
    })
  },

    viewQrCode: function() {
      wx.showLoading({
        title: '正在生成中~',
      })
      //获取团长二维码
      util.post('grouperQrCode', {}, res => {
       
        wx.hideLoading();
        wx.previewImage({
          urls: [res]
        })  
      });      
    }
})