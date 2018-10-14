// pages/shoppingcart/shoppingcart.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    total_fee:0,
    delBtnWidth:180
  },
  onLoad: function (options) {
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Cart/getList',
      data:{
        user_id:wx.getStorageSync('userid'),
        mall_id:2
      },
      success:res=>{
        var data = res.data.data;
        var select = [];
        for(var v in data){
          select.push(0);
          data[v]['txtStyle'] = ''
        }
        this.setData({
          list: data,
          select: select
        })
      }
    })
  },
  touchS: function (e) {
    if (e.touches.length == 1) {
      this.setData({
        //设置触摸起始点水平方向位置
        startX: e.touches[0].clientX
      });
    }
  },
  touchM: function (e) {
    if (e.touches.length == 1) {
      //手指移动时水平方向位置
      var moveX = e.touches[0].clientX;
      //手指起始点位置与移动期间的差值
      var disX = this.data.startX - moveX;
      var delBtnWidth = this.data.delBtnWidth;
      var txtStyle = "";
      if (disX == 0 || disX < 0) {//如果移动距离小于等于0，文本层位置不变
        txtStyle = "left:0rpx";
      } else if (disX > 0) {//移动距离大于0，文本层left值等于手指移动距离
        txtStyle = "left:-" + disX + "rpx";
        if (disX >= delBtnWidth) {
          //控制手指移动距离最大值为删除按钮的宽度
          txtStyle = "left:-" + delBtnWidth + "rpx";
        }
      }
      //获取手指触摸的是哪一项
      var index = e.currentTarget.dataset.index;
      var list = this.data.list;
      list[index]['txtStyle'] = txtStyle;
      //更新列表的状态
      this.setData({
        list: list
      });
    }
  },
  touchE: function (e) {
    if (e.changedTouches.length == 1) {
      //手指移动结束后水平位置
      var endX = e.changedTouches[0].clientX;
      //触摸开始与结束，手指移动的距离
      var disX = this.data.startX - endX;
      var delBtnWidth = this.data.delBtnWidth;
      //如果距离小于删除按钮的1/2，不显示删除按钮
      var txtStyle = disX > delBtnWidth / 2 ? "left:-" + delBtnWidth + "rpx" : "left:0rpx";
      //获取手指触摸的是哪一项
      var index = e.currentTarget.dataset.index;
      var list = this.data.list;
      var del_index = '';
      disX > delBtnWidth / 2 ? del_index = index : del_index = '';
      list[index].txtStyle = txtStyle;
      //更新列表的状态
      this.setData({
        list: list,
        del_index: del_index
      });
    }
  },
  select:function(e){
    var index = e.currentTarget.dataset.index;
    var select = this.data.select;
    select[index] = !select[index];
    this.setData({
      select: select
    })
    //判断全选
    var all_select = 1;
    for (var c in select){
      if(!select[c]){
        all_select = 0
      }
    }
    this.setData({
      all_select: all_select
    })
    this.getSelectItemAndPrice();
  },
  //全选切换
  select_all:function(e){
    var select = this.data.select;
    for (var a in select) {
      select[a] = !this.data.all_select;
    }
    this.setData({
      select: select,
      all_select: !this.data.all_select
    })
    this.getSelectItemAndPrice();
  },
  getSelectItemAndPrice:function(){
    //获取选择项
    var select = this.data.select;
    var first = 1;
    var total_fee = 0;
    this.data.cart_id = '';
    for (var c in select) {
      if (select[c]) {
        if (first) {
          this.data.cart_id = this.data.list[c]['id'];
          first = 0;
        } else {
          this.data.cart_id += '_' + this.data.list[c]['id'];
        }
        total_fee += this.data.list[c]['single_price'] * this.data.list[c]['num'] * 1.00;
      }
    }
    this.setData({
      total_fee: total_fee.toFixed(2)
    })
    console.log(this.data.cart_id)
  },
  delItem:function(e){
    var id = e.currentTarget.dataset.id;
    var index = e.currentTarget.dataset.index;
    wx.request({
      url:'http://wechat.threemall.jianfengweb.com/Cart/delete_do',
      data:{
        cart_id:id
      },
      success:res=>{
        this.data.list.splice(index,1)
        this.setData({
          list: this.data.list
        })
      }
    })
  },
  toSettle:function(e){
    if (this.data.cart_id){
      wx.navigateTo({
        url: '/pages/queren/queren?cart_id=' + this.data.cart_id,
      })
    }
    
  },
  onPullDownRefresh: function () {
    console.log("123")
    wx.showNavigationBarLoading();
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Cart/getList',
      data: {
        user_id: wx.getStorageSync('userid'),
        mall_id: 2
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
  onShow:function(e){
    this.onLoad();
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
  
  },
  goinfo: function (e) {
    wx.navigateTo({
      url: "/pages/detailedinfo/detailedinfo?id=" + e.currentTarget.dataset.id,
    });
  },
})