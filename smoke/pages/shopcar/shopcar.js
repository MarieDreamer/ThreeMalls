// pages/shopcar/shopcar.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    cartarray: [],
    select_all: 0,
    total_price: 0,
  
  },
  goxiangqing: function(e){
    wx.navigateTo({
      url: '/pages/spxiangqing/spxiangqing?id=' + e.currentTarget.dataset.id,
    })
  },
  delItem: function (e) {
    var id = e.currentTarget.dataset.id;
    var index = e.currentTarget.dataset.index;
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Cart/delete_do',
      data: {
        cart_id: id
      },
      success: res => {
        this.data.list.splice(index, 1)
        this.setData({
          cartarray: this.data.list
        })
      }
    })
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    let that = this;
    var userid = wx.getStorageSync('userid');
    // console.log(userid);
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Cart/getList',
      data: {
        user_id: userid,
        mall_id: 3,
      },
      success: function (res) {
        // console.log(res.data.data);
        that.setData({
          cartarray: res.data.data,
        })

      }
    })
  },
  // 下拉刷新
  onPullDownRefresh: function () {
    wx.showNavigationBarLoading();
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Cart/getList',
      data: {
        user_id: wx.getStorageSync('userid'),
        mall_id: 3
      },
      success: res => {
        var data = res.data.data;
        var select = [];
        for (var v in data) {
          select.push(0)
        }
        this.setData({
          list: data,
          select: select
        })
        wx.hideNavigationBarLoading();
        wx.stopPullDownRefresh();
      }
    })
  },
  onShow: function () {
    let that = this;
    var userid = wx.getStorageSync('userid');
    console.log(userid);
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Cart/getList',
      data: {
        user_id: userid,
        mall_id: 3,
      },
      success: function (res) {
        // console.log(res.data.data);
        that.setData({
          cartarray: res.data.data,
        })

      }
    })
  },


  choicefun: function (t) {
    var a = this;
    var id = t.currentTarget.dataset.id;
    // console.log(id);
    var cartList = this.data.cartarray;
    // console.log(cartList);
    var amount = 0;
    var checked_num = 0
    for (var i = 0; i < cartList.length; i++) {
      if (cartList[i]['id'] == id) {
        if (!cartList[i]['selected']) {
          cartList[i]['selected'] = 1
        } else {
          cartList[i]['selected'] = 0
        }
      }
      if (cartList[i]['selected'] == 1) {
        amount += cartList[i]['num'] * cartList[i]['single_price']
      }
      if (cartList[i]['selected'] == 1) {
        checked_num++;
      }
      console.log(amount);
      a.setData({
        total_price: amount
      })
    }
    if (checked_num == cartList.length) {
      a.setData({
        select_all: 1
      });
    } else {
      a.setData({
        select_all: 0
      });
    }
    // console.log(cartList);
    a.setData({
      cartarray: cartList
    });
  },

  SelectAll: function () {
    console.log("全选");
    var t = this;
    var a = t.data.select_all;
    var e = t.data.cartarray;
    var s = {};
    console.log(a);
    console.log(e);
    console.log(s);

    if (1 == a) {
      s.select_all = 0;
      for (var r in e) s["cartarray[" + r + "].selected"] = 0;
      t.setData({
        total_price: 0
      })
    } else {
      s.select_all = 1;
      for (var r in e) s["cartarray[" + r + "].selected"] = 1;
      this.total();
    }
    t.setData(s);

  },

  total: function () {
    var that = this;
    var total = 0;
    var cartList = that.data.cartarray;
    for (var i = 0; i < cartList.length; i++) {
      var price = parseFloat(cartList[i]['single_price']);
      var num = cartList[i]['num'];
      total += price * num;
    }
    that.setData({
      total_price: total
    })
  },

  goqueren: function () {
    var a = 0, e = this.data.cartarray;
    var total_price = this.data.total_price;
    // for (var s in e) 1 == e[s].selected && (a += 1);
    // if (!(a > 0)) return t.showModal({
    //   content: " 请选择要结算的商品！"
    // }), !1;
    var order = [];
    for (var i in e) {
      if (e[i].selected == 1) {
        order.push(e[i])
      }
    }
    wx.setStorageSync('json', order);
    // console.log(order);
    // console.log(total_price);

    if (order[0]) {
      wx.navigateTo({
        url: "/pages/queren/queren?total_price=" + total_price,
      });
    } else {
      wx.showToast({
        icon: 'none',
        title: "至少选中一件商品",
        duration: 800,
      })
    }

  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {
  
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