// pages/orderlist/orderlist.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
  },
  
  onLoad: function (options) {
    this.setData({
      userimage: wx.getStorageSync('userimage'),
      username: wx.getStorageSync('username')
    })
  },

})