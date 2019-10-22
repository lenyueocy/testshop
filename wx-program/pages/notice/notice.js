const app = getApp();
const util = require('../../utils/util.js');
Page({

    /**
     * 页面的初始数据
     */
    data: {
        noticeList: [],
    },
    onLoad: function(options) {
        util.post('noticeList', {}, res => {
            this.setData({
                noticeList: res
            })
        })
    },
    toDetail: function(e) {
        var inc = e.currentTarget.dataset.inc;
        app.globalData.notice = this.data.noticeList[inc];
        if(app.globalData.notice.isRead == 2){
            util.post('readMsg',{msgid:app.globalData.notice.id},()=>{
                this.data.noticeList[inc].isRead =1;
                this.setData({
                    noticeList:this.data.noticeList
                });
            })
        }


        wx.navigateTo({
            url: '/pages/noticeDetail/noticeDetail'
        });
    },
})