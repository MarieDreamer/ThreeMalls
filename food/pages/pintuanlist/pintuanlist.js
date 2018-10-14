// pages/pintuanlist/pintuan.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    bar: [, , '拼团失败'],
    bar: [
      { 'name': '拼团中', 'selected': 1 },
      { 'name': '拼团成功', 'selected': 0 },
      { 'name': '拼团失败', 'selected': 0 },
    ]
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
      data: {
        user_id: wx.getStorageSync('userid'),
        mall_id: 1,
        spell_status: 1
      },
      success: res => {
        console.log(res);
        this.setData({
          list: res.data.data
        })
      }
    })
  },
  select_bar: function (e) {
    var bar = this.data.bar;
    var index = e.currentTarget.dataset.index;
    for (var v in bar) {
      v == index ? bar[v]['selected'] = 1 : bar[v]['selected'] = 0;
    }
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
      data: {
        user_id: wx.getStorageSync('userid'),
        mall_id: 1,
        spell_status: index + 1
      },
      success: res => {
        this.setData({
          list: res.data.data,
          bar: bar
        })
      }
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