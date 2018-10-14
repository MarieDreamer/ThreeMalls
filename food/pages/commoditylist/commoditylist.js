// pages/commoditylist/commoditylist.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    volumeclass: "screentext",
    newtextclass: "screentextred",
    priceclass: "screentext",
    shop_type:'',
    order:"id",
    lists:[],
  
  },

  //销量按钮
  volumefun: function () {
    var that = this;
    that.setData({
      volumeclass: "screentextred",
      newtextclass: "screentext",
      priceclass: "screentext",
      order: "shop_sale",
    })
    that.loadlists();
  },

  //最新按钮
  newclassfun: function () {
    var that = this;
    that.setData({
      volumeclass: "screentext",
      newtextclass: "screentextred",
      priceclass: "screentext",
      order :"id",
    })
    that.loadlists();
  },

  //价格按钮
  priceclassfun: function () {
    var that = this;
    that.setData({
      volumeclass: "screentext",
      newtextclass: "screentext",
      priceclass: "screentextred",
      order: "shop_price",
    })
    that.loadlists();
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that = this;
    var categoryid = options.categoryid;
    that.setData({
      shop_type: categoryid,
    })
    that.loadlists();
  
  },

  //加载商品
  loadlists: function () {
    var that = this;
    var shop_type = that.data.shop_type;
    var order = that.data.order;
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Commodity/lists',
      data: {
        mall_id: 1,
        page: 1,
        main_class: shop_type,
        order: order,
      },
      success: function (res) {
        var lists = res.data.data;
        that.setData({
          lists: lists,
        })
        // console.log(lists);
      }
    })

  },

  //商品跳转
  gocommodity: function (e) {
    console.log(e.currentTarget.dataset.id);
    wx.navigateTo({
      url: '/pages/pintuan/pintuan?id=' + e.currentTarget.dataset.id,
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
    console.log(123131);
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