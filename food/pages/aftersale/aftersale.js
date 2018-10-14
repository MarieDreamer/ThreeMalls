// pages/aftersale/aftersale.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    tab:['申请售后','申请记录']
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    
  },

  select_tab:function(e){
    this.setData({
      select_tab:e.currentTarget.dataset.index
    })
  }
})