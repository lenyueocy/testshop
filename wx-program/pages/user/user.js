const app = getApp();
const util = require('../../utils/util.js')
Page({
    data: {
        getUser: {},
    },
    onLoad: function(options) {
        app.getUser(getUser => {
            //console.log(userInfo)
            this.setData({
                getUser: getUser
            });

        });
    },
    formSubmit: function(e) {
        var data = e.detail.value;
        if (!data.realname) {
            util.tip('请输入您的姓名');
            return false;
        }
        if (!data.mobile) {
            util.tip('请输入您的手机号');
            return false;
        }
        if (!/^1\d{10}$/.test(data.mobile)) {
            util.tip('手机号格式错误');
            return false;
        }
        if (!data.title) {
            util.tip('请输入您的小区');
            return false;
        }
        if (!data.address) {
            util.tip('请输入您的地址');
            return false;
        }
        util.post('user', data, res => {
            util.tip('修改成功');
        })
    },

})