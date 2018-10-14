// pages/search/search.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
  
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    this.data.page = 1;
    this.data.order = 'id';
    this.setData({
      key: options.key,
      selectIndex: 0
    })
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Commodity/lists',
      data: {
        mall_id: 3,
        key: this.data.key,
        order: this.data.order,
        page: this.data.page
      },
      success: res => {
        this.setData({
          list: res.data.data
        })
      }
    })
  },
  search: function (e) {
    this.data.page = 1;
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Commodity/lists',
      data: {
        mall_id: 3,
        key: this.data.key,
        order: this.data.order,
        page: this.data.page
      },
      success: res => {
        this.setData({
          list: res.data.data
        })
      }
    })
  },
  input: function (e) {
    // console.log(e);
    this.data.key = e.detail.value;
  },
  clear: function (e) {
    this.setData({
      key: ''
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