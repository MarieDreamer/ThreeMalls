// pages/orderlist/orderlist.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    quanbu: "dingbuanniured",
    daifukuan: "dingbuanniu",
    daishouhuo: "dingbuanniu",
    yiwancheng: "dingbuanniu",
  },
  quanbu:function(){
    let that=this;
    that.setData({
      quanbu: "dingbuanniured",
      daifukuan: "dingbuanniu",
      daishouhuo: "dingbuanniu",
      yiwancheng: "dingbuanniu",
    })
  },
  daifukuan: function () {
    let that = this;
    that.setData({
      quanbu: "dingbuanniu",
      daifukuan: "dingbuanniured",
      daishouhuo: "dingbuanniu",
      yiwancheng: "dingbuanniu",
    })
  },
  daishouhuo: function () {
    let that = this;
    that.setData({
      quanbu: "dingbuanniu",
      daifukuan: "dingbuanniu",
      daishouhuo: "dingbuanniured",
      yiwancheng: "dingbuanniu",
    })
  },
  yiwancheng: function () {
    let that = this;
    that.setData({
      quanbu: "dingbuanniu",
      daifukuan: "dingbuanniu",
      daishouhuo: "dingbuanniu",
      yiwancheng: "dingbuanniured",
    })
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
  
  },

  //去订单详细
  goorderdetails: function () {
    wx.navigateTo({
      url: "/pages/goorderdetails/goorderdetails",
    });
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