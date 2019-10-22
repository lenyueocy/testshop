const util = require('../../utils/util.js');
Page({
    data: {
        height: 0,
        start: 0,
        end: 0,
        listData: [],
    },
    onLoad: function(options) {
        var info = wx.getSystemInfoSync();
        this.setData({
            height: info.windowHeight
        });
        this.getList();
    },

    getList: function() {
    
        util.post('grouperAccount', { start: this.data.start, end: this.data.end }, res => {
         console.log(res);
         if(res.state==1){
           if(res.lists.length==0){
             wx.showToast({
               title: '暂无数据',
               icon: 'none',
               duration: 2000
             })
            }
           this.setData({
             listData: res.lists
           })
         }else{
           wx.showToast({
             title: res.msg,
             icon: 'none',
             duration: 2000
           })

         }
          
        })
    },

    bindDateChange: function(e) {
        var field = e.currentTarget.dataset.field;
        var obj = {};
        obj[field] = e.detail.value;
       // console.log(obj);
        this.setData(obj);
    }
})