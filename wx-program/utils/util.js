const url = require('./url.js')
const formatTime = date => {
    const year = date.getFullYear()
    const month = date.getMonth() + 1
    const day = date.getDate()
    const hour = date.getHours()
    const minute = date.getMinutes()
    const second = date.getSeconds()

    return [year, month, day].map(formatNumber).join('/') + ' ' + [hour, minute, second].map(formatNumber).join(':')
}

const formatNumber = n => {
    n = n.toString()
    return n[1] ? n : '0' + n
}

const DEFAULT_ERR = { status: -1, info: '服务器出错了，请重试', data: '' };

const request = (uri, data, succ, err, holeBack = false) => {
    data = data || {};
    data.site = 7;
    wx.request({
        url: url.getUrl(uri),
        // method: 'POST',
        data: data,
        success: res => {
            if (!res.data.status || res.data.status < 0) {
                if (err && typeof(err) == 'function') {
                    err(res.data);
                    return true;
                }
                if (err) {
                    tip(res.data.info);
                }
                return true;
            }
            if (!succ || !typeof(succ) == 'function') {
                return true;
            }
            if (holeBack === false) {
                succ(res.data.data);
            } else {
                succ(res.data);
            }

        },
        fail: (res) => {
            if (err && typeof(err) == 'function') {
                err(DEFAULT_ERR);
                return true;
            }
            if (err) {
              tip('服务器错误，请联系客服' );
            }
        }
    });
}

const post = (uri, data, succ, err = true, holeBack = false) => {
    var app = getApp();
    data = data || {};
    data.site = 7;
    app.getUserInfo((userInfo) => {
        data._s = userInfo.sessionkey || '';
        request(uri, data, succ, err, holeBack);
    });
}

const tip = (msg) => {
    wx.showToast({
        title: msg,
        mask: true,
        icon: 'none'
    });
}

const setBadge = (length) => {
    if (length <= 0) {
        wx.removeTabBarBadge({
            index: 2
        })
    } else {
        wx.setTabBarBadge({
            index: 2,
            text: length + "",
        });
    }
}

const getCurrentPageUrlWithArgs = () => {
    var pages = getCurrentPages() //获取加载的页面
    var currentPage = pages[pages.length - 1] //获取当前页面的对象
    var url = currentPage.route //当前页面url
    var options = currentPage.options //如果要获取url中所带的参数可以查看options

    //拼接url的参数
    var urlWithArgs = url + '?'
    for (var key in options) {
        var value = options[key]
        urlWithArgs += key + '=' + value + '&'
    }
    urlWithArgs = urlWithArgs.substring(0, urlWithArgs.length - 1)

    return urlWithArgs
}

module.exports = {
    formatTime: formatTime,
    post: post,
    request: request,
    getUrl: url.getUrl,
    tip: tip,
    setBadge: setBadge,
    pageUrl: getCurrentPageUrlWithArgs
}