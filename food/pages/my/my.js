
Page({

  data: {
  
  },

  onLoad: function (options) {
    this.setData({
      userimage:wx.getStorageSync('userimage'),
      username:wx.getStorageSync('username')
    })
  },

})