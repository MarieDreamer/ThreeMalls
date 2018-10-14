// pages/welfare.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    broadcastimglists: [],
  
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    let that = this;
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Broadcastimg/lists',
      data: {
        class: "4",
      },
      success: function (res) {
        // console.log(res.data.lists);
        if (res.data.lists) {
          that.setData({
            broadcastimglists: res.data.lists,
          })
        }


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
  
  },
  gopartner: function(){
    wx.navigateTo({
      url: "/pages/partner/partner",
    });
  },
  gopintuan: function(){
    wx.navigateTo({
      url: '/pages/pintuan/pintuan',
    });
  },
  gomiaosha: function(){
    wx.navigateTo({
      url: '/pages/xianshimiaosha/xianshimiaosha',
    })
  },
  gofree: function () {
    wx.navigateTo({
      url: "/pages/freeshichuan/freeshichuan",
    });
  },
  gohuiyuan: function () {
    wx.navigateTo({
      url: "/pages/detailedinfo/detailedinfo",
    });
  },
  gojifen: function () {
    wx.navigateTo({
      url: "/pages/jifen/jifen",
    });
  },
  goxinpin:function(){
    wx.navigateTo({
      url: '/pages/xinpin/xinpin',
    })
  }
})