// pages/class/class.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    lists:[],
  
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    let that = this;
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Category/lists',
      data: {
        mall_id: 1,
        pid: 0,
      },
      success: function (res) {
        console.log(res.data.lists);
        var lists = res.data.lists;
        that.setData({
          lists: lists,
        })

      }
    })
  
  },

  //去商品页面
  gocommoditylist: function (e) {
    // console.log(e.currentTarget.dataset.categoryid);
    var categoryid = e.currentTarget.dataset.categoryid;

    wx.navigateTo({
      url: "/pages/commoditylist/commoditylist?categoryid=" + categoryid,
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