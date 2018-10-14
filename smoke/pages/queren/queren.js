// pages/queren/queren.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    price: "",
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    this.data.cart_id = options.cart_id;
    //从购物车来的
    if (options.cart_id != undefined && options.total_fee != undefined) {
      wx.request({
        url: 'http://wechat.threemall.jianfengweb.com/Cart/getCart',
        data: {
          cart_id: options.cart_id
        },
        success: res => {
          this.setData({
            cartList: res.data.data,
            total_fee: options.total_fee
          })
        }
      })
    } else if (options.goods != undefined) {
      var goods = JSON.parse(options.goods);
      this.setData({
        goods: goods
      })
    }
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Address/lists',
      data: {
        mall_id: 3,
        userid: wx.getStorageSync('userid'),
      },
      success: res => {
        // console.log(res)
        this.setData({
          address: res.data.lists[0]
        })
      }
    })
  },
  order: function (e) {
    //从购物车来的
    if (this.data.cart_id != undefined && this.data.total_fee != undefined) {
      wx.request({
        url: 'http://wechat.threemall.jianfengweb.com/Order/adds_do',
        data: {
          cart_id: this.data.cart_id,
          user_id: wx.getStorageSync('userid'),
          mall_id: 3,
          address_id: this.data.address['id'],
          message: this.data.message,
          is_spell_group: 0
        },
        success: res => {

        }
      })
      //从立即购买来的
    } else if (this.data.goods != undefined) {
      var goods = this.data.goods;
      wx.request({
        url: 'http://wechat.threemall.jianfengweb.com/Order/adds_do',
        data: {
          commodity_id: goods['commodity_id'],
          size: goods['size'],
          color: goods['color'],
          num: goods['num'],
          price: goods['price'],
          user_id: wx.getStorageSync('userid'),
          mall_id: 3,
          message: this.data.message,
          address_id: this.data.address['id'],
          is_spell_group: goods['is_spell_group']
        },
        success: res => {
          wx.showToast({
            title: '下单成功',
            icon: 'succes',
            mask: true,
            duration: 1000
          })
        }
      })
    }

  },
  message: function (e) {
    this.data.message = e.detail.value;
  },
  goaddres:function(){
    wx.navigateTo({
      url: '/pages/addres/addres?select=1',
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
    if (wx.getStorageSync('select_addr_id')) {
      wx.request({
        url: 'http://wechat.threemall.jianfengweb.com/Address/getAddress',
        data: {
          id: wx.getStorageSync('select_addr_id')
        },
        success: res => {
          this.setData({
            address: res.data.data
          })
        }
      })
    }
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