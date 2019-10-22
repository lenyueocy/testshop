var goodsId = 0;
const util = require('../../utils/util.js');
const app = getApp();
Page({
    data: {
        opt: 1, // 1:商品说明  2：购买记录
        detail: {},
        record: [],
      numinfo:[],
        cartNum: 0,
        poster:true,
        qrcode: '',
        address: '',
        countDownList: []
    },
    onLoad: function(options) {
      wx.hideShareMenu();
      var fromid = options.scene || 0;
      app.globalData.fromid = fromid;
      app.getUserInfo((userInfo) => {
    
        if (!userInfo.userid) {
          wx.redirectTo({
            url: '/pages/grant/grant?fromid=' + fromid
          });
          return true;
        }
        if (!parseInt(userInfo.mobile)) {
          wx.redirectTo({
            url: '/pages/grant/grant?model=5'
          })
          return true;
        }
        if (!parseInt(userInfo.fromid) && userInfo.type == 1) {
          wx.redirectTo({
            url: '/pages/grant/grant?model=2'
          })
          return true;
        }
     

      });

      goodsId = options.gudsid;
      util.post('goodsDetail', { goodsid: goodsId }, res => {
      
        if (res.info.title.length > 20){
          res.info.titleLimit = res.info.title.substr(0, 18)+'...';
        }else{
          res.info.titleLimit = res.info.title
        }
        if (res.info.imageUrl.length == 0){
          res.info.imageUrl[0] = "../../image/headpic-no.png";
        }
           
            this.setData({
                detail: res.info
            });
          // 执行倒计时函数
          this.countDown();
        });
      util.post('goodsQrcode', { goodsid: goodsId }, res => {
        this.setData({
          qrcode: res
        });
      });
      util.post('buyRecord', { goodsid: goodsId }, res => {
          //购买记录
          var numinfo=[];
        for (var keys in res) {
          if (numinfo.indexOf(res[keys].id) == -1) {
            numinfo.push(res[keys].id);
          }
        }
       


          this.setData({
            numinfo: numinfo,
              record: res
          });
      });
      util.post('searchGoods', {}, (res) => {
       
          this.setData({
              Goods: res
          });
      });
      app.getCartList(res => {
          this.setData({
              cartNum: res.length
          })
      });
      app.getAddress(addr => {
       
        this.setData({
          address: addr
        })
      })
        // 执行倒计时函数
       // this.countDown();
    },

    timeFormat(param){//小于10的格式化函数
        return param < 10 ? '0' + param : param;
    },
    countDown(){//倒计时函数
        // 获取当前时间，同时得到活动结束时间数组
        let newTime = new Date().getTime();
        let endTimeList = this.data.detail.endTimes;
        let countDownArr = [];
        // 对结束时间进行处理渲染到页面
        let endTime = new Date(endTimeList.replace(/-/g,'/')).getTime();
            let obj = null;
            // 如果活动未结束，对时间进行处理
            if (endTime - newTime >= 0){
                let time = (endTime - newTime) / 1000;
                // 获取天、时、分、秒
                let day = parseInt(time / (60 * 60 * 24));
                let hou = parseInt(time % (60 * 60 * 24) / 3600);
                let min = parseInt(time % (60 * 60 * 24) % 3600 / 60);
                let sec = parseInt(time % (60 * 60 * 24) % 3600 % 60);
                obj = {
                    day: this.timeFormat(day),
                    hou: this.timeFormat(hou),
                    min: this.timeFormat(min),
                    sec: this.timeFormat(sec)
                }
            }else{//活动已结束，全部设置为'00'
                obj = {
                    day: '00',
                    hou: '00',
                    min: '00',
                    sec: '00'
                }
                clearTimeout();
            }
            countDownArr.push(obj);

        // 渲染，然后每隔一秒执行一次倒计时函数
        this.setData({ countDownList: countDownArr})
        setTimeout(this.countDown,1000);
        // console.log(this.data.countDownList);
    },
    //tab切换
    selectTab: function(e) {
        this.setData({
            opt: e.currentTarget.dataset.opt
        })
    },

    viewImage: function(e) {
        var inc = e.currentTarget.dataset.inc;
        wx.previewImage({
            current: this.data.detail.atlasImage[inc],
            urls: this.data.detail.atlasImage
        })
    },

    //加入购物车
    addCart: function() {
        let newTime = new Date().getTime();
        let endTimeList = this.data.detail.endTimes;
        let endTime = new Date(endTimeList.replace(/-/g,'/')).getTime();
        console.log(endTimeList);
        if(endTime -newTime >=0){
            util.post('addCart', { goodsid: goodsId, skuid: 0, num: 1 }, res => {
                util.tip('加入购物车成功');
                this.setData({
                    cartNum: res.length
                });
                app.setCartList(res);
            })
        }else {
            wx.showToast({
                title:"活动时间已结束",
                icon: 'none',
                duration: 2000
            })
        }

    },
    toIndex: function() {
        wx.switchTab({
            url: '/pages/index/index'
        })
    },
    toConfirm: function() {
        let newTime = new Date().getTime();
        let endTimeList = this.data.detail.endTimes;
        let endTime = new Date(endTimeList.replace(/-/g,'/')).getTime();
        if(endTime -newTime >=0){
            util.post('addTempOrder', { goodsid: goodsId, skuid: 0, num: 1, type: 2 }, (res) => {
                wx.navigateTo({
                    url: '/pages/confirm/confirm?tempid=' + res.tempid
                })
            });
        }else {
            wx.showToast({
                title:"活动时间已结束",
                icon: 'none',
                duration: 2000
            })
        }

    },

    onShareAppMessage: function(e) {
      wx.showShareMenu();
      return {
        title: this.data.detail.title,
        path: '/pages/detail/detail?gudsid=' + this.data.detail.id + '&scene=' + app.globalData.userInfo.userid
      }
    },

  shadow:function(){
    wx.hideShareMenu();
    this.setData({
      poster: true,
    })
  },

    //商品海报
  poster:function(){
    this.setData({
      poster: false,
    })
  },

    viewEwm: function (e) {
      var url = e.currentTarget.dataset.src;
      wx.previewImage({
        current: url, // 当前显示图片的http链接
        urls: [url] // 需要预览的图片http链接列表
      });

  },

})