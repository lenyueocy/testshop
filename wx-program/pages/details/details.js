const app = getApp();
const util = require('../../utils/util');
Page({
    data: {
        myTotal: {},
    },
    onLoad: function(options) {
        util.post('myTotal', {}, res => {
            console.log(res);
            for(var i=0;i<res.length;i++){
              res[i].des = res[i].title.split("-")[0];
              res[i].order = res[i].title.split("-")[1];

            }
            this.setData({
                myTotal:res,
            })
        });
    }
})