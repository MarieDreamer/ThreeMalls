// pages/mine/mine.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
  
  },
  daifukuan:function(){
    var a=1;
    wx.navigateTo({
      url: '/pages/order/order?a=' + a,
    })
  },
  daifahuo: function () {
    var a = 2;
    wx.navigateTo({
      url: '/pages/order/order?a=' + a,
    })
  },
  yifahuo: function () {
    var a = 3;
    wx.navigateTo({
      url: '/pages/order/order?a=' + a,
    })
  },
  yiwancheng: function () {
    var a = 4;
    wx.navigateTo({
      url: '/pages/order/order?a=' + a,
    })
  },
  gopintuanlist:function(){
    wx.navigateTo({
      url: '/pages/pintuanlist/pintuanlist',
    })
  },
  goorder:function(){
    var a=0;
    wx.navigateTo({
      url: '/pages/order/order?a=' + a,
    })
  },
  goaddres:function(){
    wx.navigateTo({
      url: '/pages/addres/addres',
    })
  },
  goyouhuiquan: function(){
    wx.navigateTo({
      url: '/pages/youhuiquan/youhuiquan',
    })
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    this.setData({
      userimage: wx.getStorageSync('userimage'),
      username: wx.getStorageSync('username')
    })
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {
  
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {
  
  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {
  
  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {
  
  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {
  
  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {
  
  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {
  
  }
})