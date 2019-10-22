const app = getApp();
const util = require('../../utils/util.js');
Page({
    data: {
        address: {},
    },
    onLoad: function(options) {
        app.getAddress(address => {
            this.setData({
                address: address
            });
        })
    },
    //切换团长
    switchArea:function(e){
        var inc = e.currentTarget.dataset.inc;
        var fromid = this.data.areaList[inc]['userid'];
        util.post('setArea', {fromid:fromid}, (res) => {
            if(res){
                wx.switchTab({
                    url: '/pages/index/index'
                })
            }else {
                wx.showToast({
                    title:res.msg,
                    icon: 'none',
                    duration: 2000
                })
            }
        });
    },
    onShow:function(){
        //获取团长列表
        wx.getLocation({
            success: (res) => {
                // console.log(res.latitude)
                // console.log(res.longitude)
                util.post('areaList', {lat: res.latitude, lng: res.longitude}, (res) => {
                    console.log(res)
                    this.setData({
                        // modelStatus: 1,
                        areaList: res
                    })
                });
            },
            fail: (res) => {
                // this.setData({
                //     // modelStatus: 5,
                // });
            }
        })

    }
})