// pages/dingdan/dingdan.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    tabBar:[
      '全部','待付款','待收货','已完成'
    ]
  },

  onLoad: function (options) {
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
      data:{
        user_id:wx.getStorageSync('userid'),
        mall_id:1
      },
      success:res=>{
        this.setData({
          list:res.data.data,
          select_index: 0
        })
      }
    })
  },
  pay:function(e){
    var id = e.currentTarget.dataset.id;
    wx:wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Order/pay',
      data:{
        id:id
      },
      success: res=> {
        if(res.data.status == 1){
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
  cancel:function(e){

  },
  change_tab:function(e){
    var index = e.currentTarget.dataset.index;
    var status = index-1;
    if (index == 0){
      status = 4;
    }
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
      data:{
        user_id: wx.getStorageSync('userid'),
        mall_id: 1,
        status:status
      },
      success:res=>{
        this.setData({
          select_index: index,
          list: res.data.data
        })
      }
    })
  }
})