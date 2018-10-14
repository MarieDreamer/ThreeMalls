// pages/order/order.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    recommendclass: 'orderchoiceblue',
    newProductclass: 'orderchoice',
    livingHomeclass: 'orderchoice',
    kitchenclass: 'orderchoice',
    clothclass: 'orderchoice',
    list:[],
  },
  recommend: function () {
    let that = this;
    that.setData({
      recommendclass: 'orderchoiceblue',
      newProductclass: 'orderchoice',
      livingHomeclass: 'orderchoice',
      kitchenclass: 'orderchoice',
      clothclass: 'orderchoice',
    })
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
      data: {
        user_id: wx.getStorageSync('userid'),
        mall_id: 3,
        status: 4,
      },
      success: res => {
        this.setData({
          list: res.data.data
        })
      }
    })
  },
  newProduct: function () {
    let that = this;
    that.setData({
      recommendclass: 'orderchoice',
      newProductclass: 'orderchoiceblue',
      livingHomeclass: 'orderchoice',
      kitchenclass: 'orderchoice',
      clothclass: 'orderchoice',
    })
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
      data: {
        user_id: wx.getStorageSync('userid'),
        mall_id: 3,
        status: 0,
      },
      success: res => {
        this.setData({
          list: res.data.data
        })
      }
    })
  },
  livingHome: function () {
    let that = this;
    that.setData({
      recommendclass: 'orderchoice',
      newProductclass: 'orderchoice',
      livingHomeclass: 'orderchoiceblue',
      kitchenclass: 'orderchoice',
      clothclass: 'orderchoice',
    })
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
      data: {
        user_id: wx.getStorageSync('userid'),
        mall_id: 3,
        status: 1,
      },
      success: res => {
        this.setData({
          list: res.data.data
        })
      }
    })
  },
  kitchen: function () {
    let that = this;
    that.setData({
      recommendclass: 'orderchoice',
      newProductclass: 'orderchoice',
      livingHomeclass: 'orderchoice',
      kitchenclass: 'orderchoiceblue',
      clothclass: 'orderchoice',
    })
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
      data: {
        user_id: wx.getStorageSync('userid'),
        mall_id: 3,
        status: 2,
      },
      success: res => {
        this.setData({
          list: res.data.data
        })
      }
    })
  },
  cloth: function () {
    let that = this;
    that.setData({
      recommendclass: 'orderchoice',
      newProductclass: 'orderchoice',
      livingHomeclass: 'orderchoice',
      kitchenclass: 'orderchoice',
      clothclass: 'orderchoiceblue',
    })
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
      data: {
        user_id: wx.getStorageSync('userid'),
        mall_id: 3,
        status: 3,
      },
      success: res => {
        this.setData({
          list: res.data.data
        })
      }
    })
  },
  goorderdetails:function(){
    wx.navigateTo({
      url: '/pages/dingdanxiangqing/dingdanxiangqing',
    })
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var that=this;
    if(options.a==1){
      that.setData({
        recommendclass: 'orderchoice',
        newProductclass: 'orderchoiceblue',
        livingHomeclass: 'orderchoice',
        kitchenclass: 'orderchoice',
        clothclass: 'orderchoice',
      })
      wx.request({
        url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
        data: {
          user_id: wx.getStorageSync('userid'),
          mall_id: 3,
          status: 0,
        },
        success: res => {
          this.setData({
            list: res.data.data
          })
        }
      })
    } 
    else if (options.a == 2){
      that.setData({
        recommendclass: 'orderchoice',
        newProductclass: 'orderchoice',
        livingHomeclass: 'orderchoiceblue',
        kitchenclass: 'orderchoice',
        clothclass: 'orderchoice',
      })
      wx.request({
        url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
        data: {
          user_id: wx.getStorageSync('userid'),
          mall_id: 3,
          status: 1,
        },

        success: res => {
          this.setData({
            list: res.data.data
          })
        }
      })
    }
    else if(options.a==3){
      that.setData({
        recommendclass: 'orderchoice',
        newProductclass: 'orderchoice',
        livingHomeclass: 'orderchoice',
        kitchenclass: 'orderchoiceblue',
        clothclass: 'orderchoice',
      })
      wx.request({
        url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
        data: {
          user_id: wx.getStorageSync('userid'),
          mall_id: 3,
          status: 2,
        },
        success: res => {
          this.setData({
            list: res.data.data
          })
        }
      })
    }
    else if (options.a==4){
      that.setData({
        recommendclass: 'orderchoice',
        newProductclass: 'orderchoice',
        livingHomeclass: 'orderchoice',
        kitchenclass: 'orderchoice',
        clothclass: 'orderchoiceblue',
      })
      wx.request({
        url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
        data: {
          user_id: wx.getStorageSync('userid'),
          mall_id: 3,
          status: 3,
        },
        success: res => {
          this.setData({
            list: res.data.data
          })
        }
      })
    }
    else{
      that.setData({
        recommendclass: 'orderchoiceblue',
        newProductclass: 'orderchoice',
        livingHomeclass: 'orderchoice',
        kitchenclass: 'orderchoice',
        clothclass: 'orderchoice',
      })
      wx.request({
        url: 'http://wechat.threemall.jianfengweb.com/Order/getList',
        data: {
          user_id: wx.getStorageSync('userid'),
          mall_id: 3,
          status: 4,
        },
        success: res => {
          console.log(res.data.data)
          this.setData({
            list: res.data.data
          })
        }
      })
    }
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