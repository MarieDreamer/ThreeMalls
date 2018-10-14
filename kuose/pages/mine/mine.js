// userimage// pages/mine/mine.js
const app = getApp()
Page({
  data: {
  },
  onLoad: function (e) {
    this.setData({
      userimage: wx.getStorageSync('userimage'),
      username: wx.getStorageSync('username')
    })
  },

})