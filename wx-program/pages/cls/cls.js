const app = getApp();
const util = require('../../utils/util.js');
Page({
    data: {
        cateList: [],
        nowInc: -1,
        gudsList: [],
        cid:0,
      noGoods: true,
      searchValue:''

    },
    onLoad: function(options) {
        util.post('goodsCategory', {}, (res) => {
         //console.log(res);
            this.setData({
                cateList: res, //分类数据
                cid: 0 //分类ID
               // gudsList: res['0'].gudsList
            });
            //获取所有分类下商品数据
          util.post('searchLists', { 'cid': 0 }, (res) => {
            this.setData({
              gudsList: res
            });
          });
        });
    },


    changeTab: function(e) {
        var inc = e.currentTarget.dataset.inc;
        var cid = e.currentTarget.dataset.cid;
     
         this.setData({
             nowInc: inc,
              cid: cid,
              // gudsList: this.data.cateList[inc].gudsList
         })
         //查询当前分类下的商品
        util.post('searchLists', {'cid': cid }, (res) => {
        
          if (res.length == 0) {
          
            this.setData({
              noGoods: false
            });
          } else {
            this.setData({
              noGoods: true
            });
          }

          this.setData({
            gudsList: res
          });
        });
    },

    //点击输入框输入文字；
    searchValueInput: function (e) {
    var value = e.detail.value;
      this.setData({
        searchValue: value,
      });
    },

    //搜索事件
    bindConfirm: function (e) {
      var searchValue = this.data.searchValue;
      var cid = this.data.cid;
      //根据关键词和分类ID搜索商品数据
      util.post('searchLists', { 'keyword': searchValue, 'cid': cid }, (res) => {
        // console.log(res);
        if (res.length == 0) {
          this.setData({
            searchValue: '',
            noGoods: false
          });
        } else {
          this.setData({
            noGoods: true
          });
        }

        this.setData({
          gudsList: res
        });

      });
    },

    //添加购物车
    addCart: function (e) {
      var inc = e.currentTarget.dataset.inc;
      var guds = this.data.gudsList[inc];
       // console.log(guds.endTimes);
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
  onShow: function () {
   this.onLoad();
  },

})



