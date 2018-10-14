// pages/dingdan/dingdan.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    tabBar:[
      '全部','待付款','待发货','待收货','已完成'
    ],
    select_index:0
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var a = 5;
    if(options && options.select_index){
      if (options.select_index == 0){
        a = 5
      }else{
        a = options.select_index;
      }
    }
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
      data:{
        user_id:wx.getStorageSync('userid'),
        mall_id:2,
        status:a - 1
      },
      success:res=>{
        this.setData({
          list:res.data.data,
          select_index: options.select_index
        })
      }
    })
  },
  change_tab:function(e){
    var index = e.currentTarget.dataset.index;
    var status = index-1;
    if (index == 0){
      status = 4;
    }
    console.log(status)
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
      data:{
        user_id: wx.getStorageSync('userid'),
        mall_id: 2,
        status:status
      },
      success:res=>{
        this.setData({
          select_index: index,
          list: res.data.data
        })
      }
    })
  },
  pay: function (e) {
    var id = e.currentTarget.dataset.id;
    wx: wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Order/pay',
      data: {
        id: id
      },
      success: res => {
        if (res.data.status == 1) {
          wx.showToast({
            title: '成功',
            mask: true,
            success: res => {
              this.onLoad()
            },
          })
        }
      },
    })
  },
})