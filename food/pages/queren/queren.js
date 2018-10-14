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
    wx.setStorageSync('select_addr_id',0)
    this.data.cart_id = options.cart_id;
    this.data.buy_type = options.buy_type;
    this.data.group_id = options.group_id;
    this.data.message = '';
    //从购物车来的
    if (options.cart_id != undefined){
      wx.request({
        url: 'http://wechat.threemall.jianfengweb.com/Cart/getCart',
        data: {
          cart_id: options.cart_id
        },
        success: res => {
          var cartList = res.data.data;
          var total_fee = 0;
          for (var a in cartList){
            total_fee += cartList[a]['single_price']*cartList[a]['num'];
          }
          this.setData({
            cartList: cartList,
            total_fee: total_fee
          })
        }
      })
      //立即购买
    } else if (options.goods != undefined){
      var goods = JSON.parse(options.goods);
      this.setData({
        goods: goods,
        buy_type: this.data.buy_type
      })
    }
    wx.request({
        url: 'http://wechat.threemall.jianfengweb.com/Address/lists',
        data: {
          mall_id: 1,
          userid: wx.getStorageSync('userid')
        },
        success: res => {
          this.setData({
            address: res.data.lists[0]
          })
        }
    })
  },
  my_address:function(e){
    wx.navigateTo({
      url: '/pages/address/address?select=1',
    })
  },
  order:function(e){
    //从购物车来的
    if (this.data.cart_id != undefined){
      wx.request({
        url: 'http://wechat.threemall.jianfengweb.com/Order/adds_do',
        data:{
          cart_id: this.data.cart_id,
          user_id:wx.getStorageSync('userid'),
          mall_id:1,
          address_id:this.data.address['id'],
          message:this.data.message,
        },
        success:res=>{
          if(res.data.status){
            wx.showToast({
              title: '下单成功',
              icon: 'succes',
              mask: true,
              duration: 1000,
              success:res=>{
                wx.navigateTo({
                  url: '../shoppingcart/shoppingcart',
                })
              }
            })
          }
        }
      })
      //从立即购买来的
    }else if(this.data.goods != undefined){
      var goods = this.data.goods;
      wx.request({
        url: 'http://wechat.threemall.jianfengweb.com/Order/buy_now',
        data: {
          commodity_id:goods['commodity_id'],
          type:goods['type'],
          num:goods['num'],
          price:goods['price'],
          buy_type: this.data.buy_type,//普通立即购买0 开团1 参团2
          user_id: wx.getStorageSync('userid'),
          mall_id:1,
          message:this.data.message,
          address_id:this.data.address['id'],
          group_id:this.data.goods['group_id']
        },
        success:res=>{
          if(res.data.status){
            wx.showToast({
              title: '下单成功',
              icon: 'succes',
              mask: true,
              duration: 1000,
              success:res=>{
                wx.navigateTo({
                  url: '../dingdan/dingdan',
                })
              }
            })
          }
        }
      })
    }
    
  },
  message:function(e){
    this.data.message = e.detail.value;
  },
  onShow() {
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
  }
})