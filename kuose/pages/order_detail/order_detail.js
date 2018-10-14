// pages/queren/queren.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    price: "",
  },
  onLoad: function (options) {
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Order/getDetail',
      data: {
        id:options.id
      },
      success: res => {
        this.setData({
          detail: res.data.data
        })
      }
    })
  },
  onShareAppMessage: function () {
    var id = this.data.detail['order_detail']['commodity_id'];
    var group_id = this.data.detail['group_id'];
    return {
      title: '参与拼团',
      path: '/page/detailedinfo/detailedinfo?id=' + id + '&group_id=' + group_id
    }
  }
})