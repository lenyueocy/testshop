//index.js
//获取应用实例
const app = getApp();
const util = require('../../utils/util.js');
var fromid = 0;
var searchValue;
var value='';
var orderList =[];
var goodsList=[];
var flag = true;
var interval;
var special = new Array();
var k;
Page({
    data: {
        goodsList: [],
        pagenum:1,
        goodsOrder:[],
        buyRecord: {},
        address: {},
        modelStatus: 1, //2获取用户信息，3打开设置，4获取位置
        swiper: [],
        noGoods: true,
        mobile:'',
        sharemobile:'',
        //购买订单定时显示
         showView: false,
         animationData: {},
        type:''
    },
    onLoad: function(options) {
      // fromid = options.scene || 0;
      k=1;
      util.post('searchLists', {}, (res) => {
          console.log(res)
        for(var i = 0;i<res.length;i++){
          res[i].titleLength = res[i].title.length
        }
    

        this.setData({
            goodsList: res
        });
          console.log(res)

      });
      special = new Array();
      this.setData({
        noneUserAvater:true,
        userAvater:"",
        message: "",
      })
   //判断是否是休市时间
   //      util.post('closeTime',{},(res)=>{
   //          //是跳转到休市页面
   //          console.log(res)
   //          let newTime = new Date().getTime();
   //          let salestart = new Date(res[0].salestart.replace(/-/g,'/')).getTime();
   //          let saleend = new Date(res[0].saleend.replace(/-/g,'/')).getTime();
   //          if(res[0].isopen==1 && salestart <= newTime <= saleend){
   //              wx.redirectTo({
   //                  url: '/pages/addr/addr'
   //              });
   //          }
   //
   //      });

      //购买订单滚动显示
      util.post('goodsOrder', {}, (res) => {
        //订单滑动显示开始
        if (res.length>0){
          var animation = wx.createAnimation({
            duration: 1000,
            timingFunction: 'linear',
          })
          this.animation = animation;
          var i=0;
        }

      });

      showView: (options.showView == "true" ? true : false)
        util.post('buyRecord', {}, (res) => {
         /// console.log(res);
            this.setData({
                buyRecord: res
            })
        });
        util.post('swiper', {}, res => {
            this.setData({
                swiper: res
            })
        })
     
        app.getUserInfo((userInfo) => {

            this.setData({
                type: userInfo.type
            })
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
            app.getAddress((address) => {
      
                this.setData({
                    address: address
                });
            });
        
            this.setData({
                mobile:app.globalData.basicData.mobile,
                sharemobile:''
            })

        });


    },
 
    userInfoBtn: function(e) {
        if (e.detail.errMsg == 'getUserInfo:fail auth deny') {
            this.setData({
                modelStatus: 3
            });
            return true;
        }
        this.setData({
            modelStatus: 1
        });
        this.register(e.detail);
    },
    register: function(data) {
        var registerData = {
            code: app.globalData.code,
            iv: data.iv,
            encryptedData: data.encryptedData,
            from: fromid,
        };
        util.request('register', registerData, (res) => {
            app.globalData.userInfo = res.user;
            this.setData({
                modelStatus: fromid ? 1 : 4
            })
        });
    },
    openSetting: function() {
        this.setData({
            modelStatus: 2,
        });
    },
    getAddress: function() {
        wx.getLocation({
            success: (res) => {
                util.post('setFrom', { lat: res.latitude, lng: res.longitude }, (res) => {
                    app.globalData.userInfo.fromid = res.fromid;
                    app.getAddress((address) => {
                        this.setData({
                            address: address,
                            modelStatus: 1,
                        });
                    });
                });
            },
            fail: (res) => {
                this.setData({
                    modelStatus: 5,
                });
            }
        });
    },

    openSettingLocation: function() {
        this.setData({
            modelStatus: 4,
        });
    },


  //点击输入框输入文字；
  searchValueInput: function (e) {
    value = e.detail.value;
    this.setData({
      searchValue: value,
      pagenum:1
    });
  },

  //搜索事件
  bindConfirm: function (e) {
    util.post('searchLists', {'keyword': value }, (res) => {
      if(res.length == 0){
        this.setData({
          // goodsList:res,
          searchValue: '',
          noGoods:false,
          // isHideLoadMore:true
        });
      }else{
        this.setData({
          goodsList: res,
          noGoods: true,
          isHideLoadMore:false

        });
      }
      
    });
  },


    //添加购物车
    addCart: function(e) {
        var inc = e.currentTarget.dataset.inc;
        var guds = this.data.goodsList[inc];
        //console.log(guds.endTimes);
        let newTime = new Date().getTime();
        let endTimeList = guds.endTimes;
        let endTime = new Date(endTimeList.replace(/-/g,'/')).getTime();
        if(endTime -newTime >=0){
            util.post('addCart', { goodsid: guds.id, skuid: 0, num: 1 }, (res) => {
                util.tip('加入购物车成功');
                app.setCartList(res);
            });
        }else {
            wx.showToast({
                title:"活动时间已结束",
                icon: 'none',
                duration: 2000
            })
        }

    },

  closeShadow:function(){
    this.setData({
      noGoods: true,
    });
  },

  onShow: function() {
      flag = true;
      special = new Array();
      app.getCartList(res => {
          app.setCartList(res);
      });

    util.post('searchLists', {}, (res) => {
  
      this.setData({
        goodsList: res
      });
    })
    util.post('swiper', {}, res => {
      this.setData({
        swiper: res
      })
    })
    app.getAddress((address) => {
     
      this.setData({
        address: address
      });
    });
    clearInterval(interval);
    this.setData({
      noneUserAvater: true,
      userAvater: "",
      message: "",
    })
    
    //购买订单滚动显示
   
    util.post('goodsOrder', {}, (res) => {
      //订单滑动显示开始

      special = res;
     
       k = 1;
      if (res.length > 0) {
        var animation = wx.createAnimation({
          duration: 1000,
          timingFunction: 'linear',
        })
        this.animation = animation;
        var i = 0;
        interval = setInterval(function () {
          if (i >= res.length) {
            // clearInterval(interval);
            i = 0;
          }
          flag = true;
          this.setData({
            noneUserAvater: false,
            userAvater: special[i].headpic,
            message: special[i].nickname + "  刚刚下了一个订单",
          })
          i++;
          k++;
         
          //缓慢显示
          if (flag) {
            var control = false;
            setTimeout(function () {
              animation.translate(0, -2).opacity(0.2).step({ duration: 200 });
              animation.translate(0, -4).opacity(0.3).step({ duration: 200 });
              animation.translate(0, -8).opacity(0.5).step({ duration: 200 });
              animation.translate(0, -12).opacity(0.7).step({ duration: 200 });
              animation.translate(0, -14).opacity(0.9).step({ duration: 200 });
              animation.translate(0, -16).opacity(1).step({ duration: 200 })
              this.setData({
                animation: animation.export()
              })
            }.bind(this), 100);
            control = true;
            if(control) {
            //缓慢消失
            setTimeout(function () {
              animation.translate(0, -16).opacity(0.9).step({ duration: 200 });
              animation.translate(0, -17).opacity(0.8).step({ duration: 200 });
              animation.translate(0, -19).opacity(0.5).step({ duration: 200 });
              animation.translate(0, -21).opacity(0.3).step({ duration: 200 });
              animation.translate(0, -23).opacity(0.2).step({ duration: 200 });
              animation.translate(0, -25).opacity(0).step({ duration: 200 });
              animation.translate(0).opacity(0).step();
              this.setData({
                animation: animation.export()
              })
            }.bind(this), 3000)
            }
          }

        }.bind(this), 8000)
        
      }
    })
  },
  onShareAppMessage: function(e) {
      return app.getShareInfo();
  },
  //拨打电话
  callPhone: function(e) {
      wx.makePhoneCall({
          phoneNumber: e.currentTarget.dataset.mobile,
          success: function() {
              console.log("拨打电话成功！")
          },
          fail: function() {
              console.log("拨打电话失败！")
          }
      })
  },

  onReachBottom: function () {
    var goodsList = this.data.goodsList;
    if (goodsList.length>0){
      var p = this.data.pagenum;
      p++;
      util.post('searchLists', { 'keyword': value ,'p':p}, (res) => {
          console.log(res);
        if (res.length == 0) {
          wx.showToast({
            title: '没有更多数据了',
            icon: 'none',
            duration: 2000
          })
        } else {
          this.setData({
            goodsList: goodsList.concat(res),
            pagenum:p
          });
        }

      });

      setTimeout(() => {
        this.setData({
          isHideLoadMore: true,
        })
      }, 1000)
    }
  },

   //切换团长跳转
    toggleMaster:function(e) {
        wx.navigateTo({
            url: '../addr/addr'
        })
    }
});