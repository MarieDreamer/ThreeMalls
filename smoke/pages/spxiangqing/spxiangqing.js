// pages/spxiangqing/spxiangqing.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    // input默认是1
    num2: 1,
    // 使用data数据对象设置样式名
    minusStatus: 'disabled',
    name:'',
    price:'',
    introduce:'',
    image:[],
    list:[],
    leixing:[],
    selected_color: '',
    num: '',
    lx:'',
    price:[]
  },
  goshopcar: function () {
    wx.switchTab({
      url: '/pages/shopcar/shopcar',
    })
  },
  gopingjia:function(){
    wx.navigateTo({
      url: '/pages/pingjia/pingjia',
    })
  },
  gofuwu: function () {
    wx.navigateTo({
      url: '/pages/fuwu/fuwu',
    })
  },
  goqueren: function () {
    wx.navigateTo({
      url: '/pages/queren/queren',
    })
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (e) {
    console.log(e.id)
    let that = this;
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Commodity/listsfind',
      data: {
        id : e.id,
      },
      success: function (res) {
        //  console.log(res)
          var name=res.data.data.shop_name;
          var introduce=res.data.data.shop_introduce;
          var price = res.data.data.shop_price;
          var image = res.data.data.shop_image;
        that.setData({
          name:name,
          introduce:introduce,
          price1:price,
          image:image,
          list:res.data.data
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
    // console.log(this.data)
    return {
      title: this.data.name,
      desc: this.data.introduce,
      path: '/pages/spxiangqing/spxiangqing?id=this.data.list.id' 
    }
  },
  // 加入购物车
  selectColor: function (e) {
    console.log(e.currentTarget.dataset.color.price)
    var color = e.currentTarget.dataset.color;
    var num = 0;
    this.data.mycolor = color;
    for (var v in this.data.color_num) {
      if (this.data.color_num[v]['color'] == color) {
        num = this.data.color_num[v]['num']
      }
    }
    // console.log(this.data.leixing);
    var lx=e.currentTarget.dataset.sst;
    this.setData({
      selected_color: e.currentTarget.dataset.index,
      num: num,
      lx:lx,
      price: color.price,
      number:color.num,
    })
  },
  enter : function(e){
    console.log(this.data.lx,);
    var lx=this.data.lx;
    var userid = wx.getStorageSync('userid');
    let that = this;
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Cart/adds_do',
      data: {
        commodity_id: e.currentTarget.dataset.st,
        mall_id:3,
        user_id:userid,
        type: lx,
        num: e.currentTarget.dataset.num,
      },
      // header: { 'content-type': 'application/x-www-form-urlencoded;charset=utf-8'},
      success: function (res) {
        // console.log(res.data.status)
        var status = res.data.status;
        if (status == 0) {
          wx.showToast({
            title: '加入购物车失败',
            duration: 2000,
            icon: "none"
          })
        }
        else if (status == 1) {
          wx.showToast({
            title: '成功加入购物车',
            duration: 2000
          })
        }
      }
    })
  },
  //显示对话框
  showModal: function (e) {
    let that=this;
    //非团购商品，判断用户是加入购物车还是立即购买
    if (e.currentTarget.dataset.buy_now != undefined) {
      this.setData({
        buy_now: e.currentTarget.dataset.buy_now
      })
    }
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
      url: 'http://wechat.threemall.jianfengweb.com/Size/getType',
      data: {
        commodity_id: e.currentTarget.dataset.st,
      },
      success: function (res) {
        console.log(res.data.data)
        that.setData({
          leixing:res.data.data,
          lx: res.data.data[0]['type'],
          price:res.data.data[0]['price'],
          number:res.data.data[0]['num']          
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
  buy_now:function(e){
    var goods = {
      user_id: wx.getStorageSync('userid'),
      commodity_id: this.data.list['id'],
      commodity_image: this.data.list['shop_index_image'][0],
      commodity_name: this.data.list['shop_name'],
      price: this.data.price * this.data.num2,
      size: this.data.lx,
      num: this.data.num2,
      is_spell_group: this.data.list['is_spell_group']
    }
    goods = JSON.stringify(goods);
    wx.navigateTo({
      url: '/pages/queren/queren?goods=' + goods,
    })
  },


})