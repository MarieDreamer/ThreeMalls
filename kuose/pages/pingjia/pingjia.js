// pages/pingjia/pingjia.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    quanbu:"fenlei-red",
    zuixin:"fenlei-white",
    zhuijia:"fenlei-white",
    youtu:"fenlei-white",
    shipin:"fenlei-white"
  },
  quanbu: function () {
    let that = this;
    that.setData({
      quanbu: "fenlei-red",
      zuixin: "fenlei-white",
      zhuijia: "fenlei-white",
      youtu: "fenlei-white",
      shipin: "fenlei-white"
    })
  },
  zuixin: function () {
    let that = this;
    that.setData({
      quanbu: "fenlei-white",
      zuixin: "fenlei-red",
      zhuijia: "fenlei-white",
      youtu: "fenlei-white",
      shipin: "fenlei-white"
    })
  },
  zhuijia: function () {
    var that = this;
    that.setData({
      quanbu: "fenlei-white",
      zuixin: "fenlei-white",
      zhuijia: "fenlei-red",
      youtu: "fenlei-white",
      shipin: "fenlei-white"
    })
  },
  youtu: function () {
    var that = this;
    that.setData({
      quanbu: "fenlei-white",
      zuixin: "fenlei-white",
      zhuijia: "fenlei-white",
      youtu: "fenlei-red",
      shipin: "fenlei-white"
    })
  },
  shipin:function(){
    var that=this;
    that.setData({
      quanbu: "fenlei-white",
      zuixin: "fenlei-white",
      zhuijia: "fenlei-white",
      youtu: "fenlei-white",
      shipin: "fenlei-red"
    })
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
  
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