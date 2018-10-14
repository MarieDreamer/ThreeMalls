// pages/pingtuan/pingtuan.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    num2:1,
    animationData:'',
    animationData2:'',
    showModalStatus:'',
    showModalStatus2:'',
    name: '',
    price: '',
    introduce: '',
    image: [],
    list: [],
    leixing: [],
    selected_color: '',
    num: '',
    lx: '',
    leixing:[],
  },
  //显示对话框,发起拼团
  showModal: function (e) {
    let that = this;
    // 显示遮罩层
    var animation = wx.createAnimation({
      duration: 200,
      timingFunction: "linear",
      delay: 0
    })
    this.animation = animation
    animation.translateY(300).step()
    this.setData({
      animationData: animation.export(),
      showModalStatus: true
    })
    setTimeout(function () {
      animation.translateY(0).step()
      this.setData({
        animationData: animation.export()
      })
    }.bind(this), 200)
    // 商品详情数据接口
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Size/gettype',
      data: {
        commodity_id: e.currentTarget.dataset.st,
      },
      success: function (res) {
        // console.log(res.data.data);
        that.setData({
          leixing: res.data.data,
        })
      }
    })
  },
  //显示对话框2
  showModal2: function (e) {
    let that = this;
    // 显示遮罩层
    var animation = wx.createAnimation({
      duration: 200,
      timingFunction: "linear",
      delay: 0
    })
    this.animation = animation
    animation.translateY(300).step()
    this.setData({
      animationData2: animation.export(),
      showModalStatus2: true
    })
    setTimeout(function () {
      animation.translateY(0).step()
      this.setData({
        animationData2: animation.export()
      })
    }.bind(this), 200)
    // 商品详情数据接口
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Size/gettype',
      data: {
        commodity_id: e.currentTarget.dataset.st,
      },
      success: function (res) {
        console.log(res.data.data);
        that.setData({
          leixing: res.data.data,
          
        })
      }
    })
  },
  //隐藏对话框
  hideModal: function () {
    // 隐藏遮罩层
    var animation = wx.createAnimation({
      duration: 200,
      timingFunction: "linear",
      delay: 0
    })
    this.animation = animation
    animation.translateY(300).step()
    this.setData({
      animationData: animation.export(),
    })
    setTimeout(function () {
      animation.translateY(0).step()
      this.setData({
        animationData: animation.export(),
        showModalStatus: false
      })
    }.bind(this), 200)
  }, 
  hideModal2: function () {
    // 隐藏遮罩层
    var animation = wx.createAnimation({
      duration: 200,
      timingFunction: "linear",
      delay: 0
    })
    // 隐藏弹出框2
    this.animation = animation
    animation.translateY(300).step()
    this.setData({
      animationData2: animation.export(),
    })
    setTimeout(function () {
      animation.translateY(0).step()
      this.setData({
        animationData2: animation.export(),
        showModalStatus2: false
      })
    }.bind(this), 200)
  },
  // 数量加减
  bindMinus: function () {
    // console.log(this.data.num2)
    var num = this.data.num2;
    // 如果大于1时，才可以减
    if (num > 1) {
      num--;
    }
    // 只有大于一件的时候，才能normal状态，否则disable状态
    var minusStatus = num <= 1 ? 'disabled' : 'normal';
    // 将数值与状态写回
    this.setData({
      num2: num,
      minusStatus: minusStatus
    });
  },
  /* 点击加号 */
  bindPlus: function () {
    var num = this.data.num2;
    // 不作过多考虑自增1
    num++;
    // 只有大于一件的时候，才能normal状态，否则disable状态
    var minusStatus = num < 1 ? 'disabled' : 'normal';
    // 将数值与状态写回
    this.setData({
      num2: num,
      minusStatus: minusStatus
    });
  },
  /* 输入框事件 */
  bindManual: function (e) {
    var num = e.detail.value;
    // 将数值与状态写回
    this.setData({
      num2: num
    });
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (e) {
    // console.log(e);
    let that = this;
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Commodity/listsfind',
      data: {
        id: e.id,
      },
      success: function (res) {
        // console.log(res.data.data)
        var name = res.data.data.shop_name;
        var introduce = res.data.data.shop_introduce;
        var price = res.data.data.shop_price;
        var image = res.data.data.shop_image;
        that.setData({
          name: name,
          introduce: introduce,
          price: price,
          image: image,
          goods: res.data.data,
        })
      }
    })
  },
  // 类型按钮变色
  selectColor: function (e) {
    var color = e.currentTarget.dataset.color;
    var num = 0;
    this.data.mycolor = color;
    for (var v in this.data.color_num) {
      if (this.data.color_num[v]['color'] == color) {
        num = this.data.color_num[v]['num']
      }
    }
    // console.log(e.currentTarget.dataset.sst);
    var lx = e.currentTarget.dataset.sst;
    this.setData({
      selected_color: e.currentTarget.dataset.index,
      num: num,
      lx: lx,
    })
  },
  // 评论跳转
  gopingjia:function(){
    wx.navigateTo({
      url: '/pages/pingjia/pingjia',
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
    console.log(this.data)
    return {
      title: this.data.name,
      desc: this.data.introduce,
      path: '/pages/pingtuan/pingtuan?id=this.data.goods.id'
    }
  },
  // 界面跳转

  // 订单确认页面
  goqueren: function (e) {
    var goods = {
      user_id: wx.getStorageSync('userid'),
      commodity_id: this.data.goods['id'],
      commodity_image: this.data.goods['shop_index_image'][0],
      commodity_name: this.data.goods['shop_name'],
      price: this.data.price * this.data.num2,
      size: this.data.lx,
      num: this.data.num2,
      is_spell_group: this.data.goods['is_spell_group']
    }
    goods = JSON.stringify(goods);
    wx.navigateTo({
      url: '/pages/queren/queren?goods=' + goods,
    })
  },
})