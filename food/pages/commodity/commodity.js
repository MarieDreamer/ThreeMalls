// pages/commodity/commodity.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    list:[],
    commoditynumber:"",
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (e) {
    var that=this;
    that.setData({
      commoditynumber: 1,
    })
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Commodity/listsfind',
      data: {
        id: e.id,
      },
      success: function (res) {
        console.log(res)
        that.setData({
          list: res.data.data,
        })
      }
    })
  },

  commodity_number_increase: function () {
    var that = this;
    var commoditynumber = that.data.commoditynumber;
    that.setData({
      commoditynumber: commoditynumber + 1,
    })
  },


  commodity_number_reduce: function () {
    var that = this;
    var commoditynumber = that.data.commoditynumber;
    that.setData({
      commoditynumber: commoditynumber - 1,
    })
  },

  goorder: function () {
    wx.navigateTo({
      url: "/pages/order/order",
    });
  },

  goevaluate: function () {
    wx.navigateTo({
      url: "/pages/evaluate/evaluate",
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