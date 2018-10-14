Page({

  /**
   * 页面的初始数据
   */
  data: {
    mynum:1,
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    this.data.page = 1;
    this.data.order = 'id';
    this.setData({
      key: options.key,
      selectIndex:0
    })
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Commodity/lists',
      data: {
        mall_id: 2,
        key: this.data.key,
        order: this.data.order,
        page: this.data.page
      },
      success: res => {
        this.setData({
          list:res.data.data
        })
      }
    })
  },

  selectbar:function(e){
    this.data.page = 1;
    this.setData({
      selectIndex: e.currentTarget.dataset.index
    })
    
    if (e.currentTarget.dataset.index == 0){
      this.data.order = 'id';
    } else if (e.currentTarget.dataset.index == 1){
      this.data.order = 'shop_sale';
    }else{
      this.data.order = 'create_time';
    }
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Commodity/lists',
      data: {
        mall_id: 2,
        key: this.data.key,
        order: this.data.order,
        page: this.data.page
      },
      success: res => {
        this.setData({
          list:res.data.data
        })
      }
    })
  },
  input:function(e){
    this.data.key = e.detail.value;
  },
  clear:function(e){
    this.setData({
      key:''
    })
  },
  search:function(e){
    this.data.page = 1;
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Commodity/lists',
      data: {
        mall_id: 2,
        key: this.data.key,
        order: this.data.order,
        page: this.data.page
      },
      success: res => {
        this.setData({
          list: res.data.data
        })
      }
    })
  },
  detail:function(e){
    wx.navigateTo({
      url: '/pages/detailedinfo/detailedinfo?id=' + e.currentTarget.dataset.id,
    })
  },
  selectColor:function(e){
    var color = e.currentTarget.dataset.color;
    var num = 0;
    this.data.mycolor = color;
    for (var v in this.data.color_num) {
      if (this.data.color_num[v]['color'] == color) {
        num = this.data.color_num[v]['num']
      }
    }
    this.setData({
      selected_color: e.currentTarget.dataset.index,
      mynum:1
    })
    if (this.data.mysize){
      var size_num = this.data.final_num;
      var is_find = 0;
      for (var v in size_num) {
        if (size_num[v]['color'] == this.data.mycolor &&
          size_num[v]['size'] == this.data.mysize) {
          is_find = 1;
          console.log(size_num[v]['num']);
          this.setData({
            num: size_num[v]['num']
          })
        }
        if (!is_find) {
          this.setData({
            num: 0
          })
        }
      }
    }else{
      this.setData({
        num: num
      })
    }
  },
  selectSize:function(e){
    this.data.mysize = e.currentTarget.dataset.size;
    this.setData({
      selected_size: e.currentTarget.dataset.index,
      mynum:1
    })
    var size_num = this.data.final_num;
    var is_find = 0;
    for(var v in size_num){
      if (size_num[v]['color'] == this.data.mycolor &&
        size_num[v]['size'] == this.data.mysize){
        is_find = 1;
        this.setData({
          num: size_num[v]['num']
        })
      }
      if (!is_find){
        this.setData({
          num: 0
        })
      }
    }
  },

  showModal: function (e) {
    this.data.mycommodity_id = e.currentTarget.dataset.id;
    this.data.price = e.currentTarget.dataset.price;
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Size/getSize',
      data:{
        commodity_id:e.currentTarget.dataset.id
      },
      success:res=>{
        this.data.standard = res.data.data;
        var data = res.data.data;
        var color = [];
        for (var a in data) {
          if (color.indexOf(data[a]['color']) < 0) {
            color.push(data[a]['color'])
          }
        }
        this.setData({
          color: color,
          selected_color: 0,
          selected_size: 0,
          mynum: 1,
          myprice: this.data.myprice
        })
        this.selectColor();
        
      }
    })
    // 显示遮罩层
    var animation  = wx.createAnimation({
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
  },
  selectColor: function (e) {
    var data = this.data.standard;
    var size = [];
    var selected_color = e ? e.currentTarget.dataset.index : this.data.selected_color;
    for (var a in data) {
      if (data[a]['color'] == this.data.color[selected_color] && size.indexOf(data[a]['size']) < 0) {
        size.push(data[a]['size'])
      }
    }
    this.setData({
      size: size,
      selected_color: selected_color,
      selected_size: 0,
      mynum: 1
    })
    this.selectSize();
  },
  selectSize: function (e) {
    var data = this.data.standard;
    var num = 0;
    var price = 0;
    var selected_size = e ? e.currentTarget.dataset.index : this.data.selected_size;
    for (var a in data) {
      if (data[a]['color'] == this.data.color[this.data.selected_color] &&
        data[a]['size'] == this.data.size[selected_size]) {
        num = data[a]['num'];
        price = data[a]['price'];
      }
    }
    if (this.data.buy_type > 0) {
      price = this.data.goods['spell']['group_price']
    }
    this.setData({
      selected_size: selected_size,
      mynum: 1,
      myprice: price,
      num: num
    })
  },
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

  adds:function(){
    if (this.data.mynum < this.data.num && this.data.mysize){
      this.setData({
        mynum: ++this.data.mynum
      })
    }
  },
  minus: function () {
    if (this.data.mynum > 1) {
      this.setData({
        mynum: --this.data.mynum
      })
    }
  },
  add_cart:function(){
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Cart/adds_do',
      data:{
        user_id:wx.getStorageSync('userid'),
        mall_id:2,
        commodity_id:this.data.mycommodity_id,
        size:this.data.mysize,
        color:this.data.mycolor,
        num:this.data.mynum,
        single_price: this.data.price
      },
      success:res=>{
        wx.switchTab({
          url: '/pages/shoppingcart/shoppingcart',
        })
      }
    })
  },
  
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