// pages/myyouhuiquan/myyouhuiquan.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    tabBar:[
     '全部','未使用','已使用','已失效'
    ]
  },

  onLoad: function (options) {
    // wx.request({
    //   url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
    //   data: {
    //     user_id: wx.getStorageSync('userid'),
    //     mall_id: 2,
    //     status: status
    //   },
    //   success: res => {
        this.setData({
          select_index: 0,
          // list: res.data.data
        })
      // }
    // })
  },
  
  change_tab: function (e) {
    var index = e.currentTarget.dataset.index;
    var status = index - 1;
    if (index == 0) {
      status = 4;
    }
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
      data: {
        user_id: wx.getStorageSync('userid'),
        mall_id: 2,
        status: status
      },
      success: res => {
        this.setData({
          select_index: index,
          list: res.data.data
        })
      }
    })
  }

})