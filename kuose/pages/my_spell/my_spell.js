// pages/dingdan/dingdan.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    bar:[
      {'name': '正在拼团','selected':1},
      {'name': '拼团成功', 'selected': 0},
      {'name': '拼团失败', 'selected': 0},
    ],
    select_bar:0
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
      data:{
        user_id:wx.getStorageSync('userid'),
        mall_id:2,
        spell_status:1
      },
      success:res=>{
        this.setData({
          list:res.data.data
        })
      }
    })
  },
  order_detail:function(e){
    var id = e.currentTarget.dataset.id;
    wx.navigateTo({
      url: '/pages/order_detail/order_detail?id=' + id,
    })
  },
  select_bar:function(e){
    var index = e.currentTarget.dataset.index;
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
      data:{
        user_id: wx.getStorageSync('userid'),
        mall_id: 2,
        spell_status: index+1
      },
      success:res=>{
        this.setData({
          list: res.data.data,
          select_bar: index
        })
      }
    })
  },
  
})