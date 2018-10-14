// pages/coupon/coupon.js
Page({

  data: {
  
  },

  onLoad: function (options) {
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/CouponUser/lists',
      data:{
        user_id:wx.getStorageSync('userid'),
        mall_id:1
      },
      success:res=>{
        this.setData({
          list:res.data.data
        })
      }
    })
  },

  
})