const util = require('../../utils/util.js');
const app = getApp();
var copyText = '';
Page({
    data: {
        countInfo: {},
        current: 1,
        newOrder: [],
        statusTitle: { 1: '未支付', 2: '待发货', 3: '已发货', 4: '已完成', 5: '已完成' }
    },
    onLoad: function() {
        util.post('grouperCount', {}, res => {
            this.setData({
                countInfo: res
            })
        });

        util.post('grouperOrder', { num: 3, status: '2,3,4,5' }, res => {
            this.setData({
                newOrder: res
            })
        });
        copyText = app.globalData.basicData.text;
    },

    changeTab: function(e) {
        this.setData({
            current: e.currentTarget.dataset.inc
        })
    },
    clipboard: function() {
        wx.setClipboardData({
            data: copyText,
            success: function(res) {
                // console.log(res);
            }
        })
    }
});