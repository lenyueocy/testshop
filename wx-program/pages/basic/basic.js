const app = getApp();
const util = require('../../utils/util.js')
Page({
    data: {
        text: "Page basic",
        address: {},

    },
    onLoad: function(options) {
        app.getAddress(addr => {
            this.setData({
                address: addr
            })
        })
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
        if (!data.email) {
            util.tip('请输入您的邮箱');
            return false;
        }
        util.post('grouperEdit', data, res => {
            util.tip('修改成功');
        })
    }
})