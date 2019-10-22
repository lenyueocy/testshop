//app.js
const util = require('./utils/util.js');
var handle;
var cbList = [];
App({
    onLaunch: function() {
     
        wx.login({
            success: res => {
                this.globalData.code = res.code;
                util.request('codeLogin', { code: res.code }, data => {
                    this.globalData.userInfo = data.user;
                    this.globalData.userReq = true;
                    this.getCartList(res => {
                        util.setBadge(res.length);
                    });
                }, err => {
                  
                    this.globalData.userReq = true;
                });
            }
        });
        util.request('getBasic', {}, res => {
           
            this.globalData.basicData = res;
        })
    },
    getUserInfo: function(cb) {
        if (this.globalData.userReq === true) {
            cb(this.globalData.userInfo);
            return;
        }
        cbList.push(cb);
        if (handle) {
            return;
        }
        handle = setInterval(() => {
            if (this.globalData.userReq === true) {
                for (var key in cbList) {
                    cbList[key](this.globalData.userInfo);
                }
                clearInterval(handle);
            }
        }, 10);
    },

    getAddress: function(cb) {
        // if (this.globalData.address.title) {
        //     cb(this.globalData.address);
        //     return true;
        // }
        this.getUserInfo((userInfo) => {
            util.post('grouperInfo', {}, (res) => {
                this.globalData.address = res;
                cb(res);
            });
        });
    },
    getUser: function(cb) {

        this.getUserInfo((userInfo) => {
            util.post('UserInfo', {}, (res) => {
                this.globalData.getUser = res;
                cb(res);
            });
        });
    },
    getShareInfo: function(path) {
        path = path || '/pages/index/index';
        if (this.globalData.userInfo.userid) {
            path += '?scene=' + (this.globalData.userInfo.type == 1 ? this.globalData.userInfo.fromid : this.globalData.userInfo.userid);
        }
        return {
            path: path,
            title: this.globalData.basicData.shareTitle,
            imageUrl: this.globalData.basicData.shareImage
        }
    },

    getCartList: function(cb) {
        if (this.globalData.cartList != false) {
            return cb(this.globalData.cartList);
        }
        util.post('cartList', {}, (res) => {
            this.globalData.cartList = res;
            return cb(res);
        });
    },

    setCartList: function(cartList) {
        this.globalData.cartList = cartList;
        var bags = 0;
      for (var i in cartList) {
        bags += cartList[i].info.num;
      }
      util.setBadge(bags);
      this.globalData.bags = bags;
        //util.setBadge(cartList.length);
    },
    globalData: {
        userInfo: {},
        code: '',
        bags:0,
        userReq: false,
        address: {},
        basicData: {},
        cartList: false,
        getUser: {},
       fromid:0
      
    }
})