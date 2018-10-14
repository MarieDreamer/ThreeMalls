// pages/homepage/homepage.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    recommendclass: 'orderchoiceblue',
    newProductclass: 'orderchoice',
    tuijian:'',
    canchu:'display',
    page:1,
    orderinfo:[],
    list:'',
    lists:[],
    hot:[],
    tabBar1: [],
  },
  // 顶部菜单栏跳转
  recommend: function () {
    let that = this;
    that.setData({
      recommendclass: 'orderchoiceblue',
      // newProduct:'orderchoice',
      tuijian: '',
      canchu: 'display',
      select_index:'10000',
    })
  },
  newProduct: function (e) {
    let that = this;
    var index = e.currentTarget.dataset.index;
    that.setData({
      recommendclass: 'orderchoice',
      tuijian: 'display',
      canchu: '',
      select_index: index,
    })
  },
  

  
  // 去中华页面
  gozhonghua:function(e){
    var id=25;
    wx.navigateTo({
      url: '/pages/pingtuan/pingtuan?id=25',
    })

  },
  // 跳转拼团界面
  gopintuan:function(e){
    wx.navigateTo({
      url: '/pages/pingtuan/pingtuan?id=' + e.currentTarget.dataset.st,
    })
  },
  // 跳转商品详情界面
  gospxiangqing:function(e){
    wx.navigateTo({
      url: '/pages/spxiangqing/spxiangqing?id=' + e.currentTarget.dataset.st,
    })
  },
  // 跳转搜索界面
  suo:function(){
    wx.navigateTo({
      url: '/pages/search/search',
    })
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    let that=this;
    // 商品列表接口
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Commodity/lists',
      data: {
        mall_id:3,
        page: 1,
      },
      success: function (res) {
        console.log(res.data.data);
        var orderinfo = res.data.data;
        that.setData({
          orderinfo: orderinfo,
        })
      }
    })
    // 轮播图接口
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Broadcastimg/lists',
      data: {
        class: 5,
      },
      success: function (res) {
        // console.log(res.data.lists)
        var img = res.data.lists;
        that.setData({
          list: img,
        })
      }
    })
    // 类别
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Category/lists',
      data: {
        mall_id: 3,
        pid: 0
      },
      success: res => {
        console.log(res.data.lists);
        this.setData({
          tabBar: res.data.lists
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