// pages/detailedinfo/detailedinfo.js
Page({
  data: {
  },
  onLoad: function (options) {
    //是不是参团链接点进来的
    if (options.group_id != undefined){
      this.data.group_id = options.group_id;
    }else{
      this.data.group_id = ''
    }
    // options.id = 22;
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Commodity/listsfind',
      data: {
        id: options.id
      },
      success: res => {
        this.setData({
          goods: res.data.data,
          selected_bar: 0,
          group_id: this.data.group_id
        })
        if (res.data.data['is_spell_group'] == 1){
          this.setData({
            remain_time: res.data.data['spell']
          })
          this.timing();
        }
      }
    })
  },
  //商品详情按钮
  detail: function () {
    this.setData({
      selected_bar:0
    })
  },
  record: function () {
    this.setData({
      selected_bar: 1
    })
  },
  gopingjia:function(){
    wx.navigateTo({
      url: '/pages/pingjia/pingjia',
    })
  },
  goqueren: function () {
    // console.log("dsjdisa")
    wx.navigateTo({
      url: '/pages/queren/queren',
    })
  },
  toCart:function(){
    wx.switchTab({
      url: '../shoppingcart/shoppingcart',
    })
  },
  toStore: function () {
    wx.switchTab({
      url: '../store/store',
    })
  },
  timing:function(){
    var that = this;
    var remain_time = this.data.remain_time;
    if (remain_time['day'] == 0 &&
    remain_time['hour'] == 0 &&
    remain_time['minute'] == 0 &&
    remain_time['second'] == 0){
    }else{
      var time = setTimeout(function () {
        if (remain_time['second'] > 0){
          remain_time['second']--;
        }else{
          remain_time['second'] = 59;
          if (remain_time['minute'] > 0){
            remain_time['minute']--;
          }else{
            remain_time['minute'] = 59;
            if (remain_time['hour'] > 0) {
              remain_time['hour']--;
            } else {
              remain_time['hour'] = 59;
              if (remain_time['day'] > 0) {
                remain_time['day']--;
              }
            }
          }
        }
        that.setData({
          remain_time: remain_time
        })
        that.timing();
      }, 1000)
    }
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
      mynum:1
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
    if(this.data.buy_type > 0){
      price = this.data.goods['spell']['group_price']
    }
    this.setData({
      selected_size: selected_size,
      mynum: 1,
      myprice: price,
      num:num
    })
  },
  adds: function () {
    if (this.data.mynum < this.data.num) {
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
  showModal: function (e) {
    //团购商品，判断用户单买还是开团
    if(e.currentTarget.dataset.single_buy != undefined){
      this.setData({
        single_buy: e.currentTarget.dataset.single_buy
      })
    }
    //非团购商品，判断用户是加入购物车还是立即购买
    if (e.currentTarget.dataset.buy_now != undefined) {
      this.setData({
        buy_now: e.currentTarget.dataset.buy_now
      })
    }
    //非加入购物车，0为普通立即购买，1为开团，2为参团
    if (e.currentTarget.dataset.buy_type != undefined) {
      this.data.buy_type = e.currentTarget.dataset.buy_type;
    }
    //团购时 价格不一样
    if (this.data.buy_type > 0){
      this.data.myprice = this.data.goods['spell']['group_price'];
    }else{
      this.data.myprice = this.data.goods['shop_price'];
    }
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Size/getSize',
      data: {
        commodity_id: this.data.goods['id']
      },
      success: res => {
        this.data.standard = res.data.data;
        var data = res.data.data;
        var color = [];
        for(var a in data){
          if (color.indexOf(data[a]['color'])<0){
            color.push(data[a]['color'])
          }
        }
        this.setData({
          color:color,
          selected_color: 0,
          selected_size: 0,
          mynum: 1,
          myprice:this.data.myprice
        })
        this.selectColor();
      }
    })
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
  add_cart: function () {
    var data = this.data.standard;
    for(var a in data){
      if (data[a]['color'] == this.data.color[this.data.selected_color] && 
      data[a]['size'] == this.data.size[this.data.selected_size]){
        var type_id = data[a]['id'];
        }
    }
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Cart/adds_do',
      data: {
        user_id: wx.getStorageSync('userid'),
        mall_id: 2,
        commodity_id: this.data.goods['id'],
        type_id: type_id,
        num: this.data.mynum,
      },
      success: res => {
        wx.showToast({
          title: '添加成功',
          icon: 'succes',
          mask:true,
          duration: 1000
        })
        this.hideModal();
      }
    })
  },
  to_buy:function(){
    var goods = {
      user_id: wx.getStorageSync('userid'),
      commodity_id: this.data.goods['id'],
      commodity_image: this.data.goods['shop_index_image'][0],
      commodity_name:this.data.goods['shop_name'],
      price: this.data.myprice,
      size: this.data.size[this.data.selected_size],
      color: this.data.color[this.data.selected_color],
      num: this.data.mynum,
      group_id:this.data.group_id
    }
    goods = JSON.stringify(goods); 
    wx.navigateTo({
      url: '/pages/queren/queren?goods='+goods+'&buy_type='+this.data.buy_type,
    })
  },
  gohomepage:function(){
    wx.navigateTo({
      url: '/pages/store/store',
    })
  },
})