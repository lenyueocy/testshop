var fromid = 0;
const app = getApp();
const util = require('../../utils/util.js');
Page({

    /**
     * 页面的初始数据
     */
    data: {
        model: 1,
    },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function(options) {
        var model = options.model || 1;
        fromid = options.scene || 0;
        this.setData({
            model: model
        })
    },

    bindGetUserInfo: function(e) {
     
        if (e.detail.errMsg == 'getUserInfo:fail auth deny') {
            this.setData({
                model: 3
            });
            return true;
        }
        var registerData = {
            code: app.globalData.code,
            iv: e.detail.iv,
            encryptedData: e.detail.encryptedData,
            from: fromid,
            mobile:0
        };
        wx.showLoading({
            title:'请求中'
        });
    
        util.request('register', registerData, (res) => {
            wx.hideLoading();
            app.globalData.userInfo = res.user;
     
          if (res.user.mobile){
            this.setData({
              model: 2
            })
          }else{
            this.setData({
              model: 5
            })
          }
            
        });
    },

    openSettingInfo: function() {
        this.setData({
            model: 1
        })
    },
  getPhoneNumber : function (e) {
        if(e.detail.errMsg == "getPhoneNumber:ok"){
          wx.showLoading({
            title: '请求中'
          });
          var numberData = {
            code: app.globalData.code,
            iv: e.detail.iv,
            encryptedData: e.detail.encryptedData
          };
        
          util.post('getphone', numberData, (res) => {
            wx.hideLoading();
            
           if(res.info==1){
             app.globalData.userInfo = res.user;
             
             if (res.fromid) {
               wx.switchTab({
                 url: '/pages/index/index'
               })
               return;
             }
             this.setData({
               model: 2
             })
            
           }else{
             wx.showModal({
               title: '提示',
               showCancel: false,
               content: res.msg,
               success: function (res) { }
             })

           }
          });
        }else{
         
          this.setData({
            model: 6
          });
          return true;
        }  
  },
  openSettingNumber: function () {
    this.setData({
      model: 5
    })
  },
    bindGetLocation: function() {
        wx.getLocation({
            success: (res) => {
                wx.showLoading({
                    title:'请求中'
                });
          
                util.post('setFrom', { lat: res.latitude, lng: res.longitude }, (res) => {
                    wx.hideLoading();
                    app.globalData.userInfo.fromid = res.fromid;
                    app.getAddress((address) => {
                         wx.switchTab({
                             url: '/pages/index/index'
                         });
                    });
                });
            },
            fail: (res) => {
               // console.log(res);
                this.setData({
                    model: 4,
                });
            }
        });
    },

    openSettingLocation: function() {
        this.setData({
            model: 2
        })
    }
})