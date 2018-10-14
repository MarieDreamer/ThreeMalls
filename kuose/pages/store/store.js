// pages/store/store.js
var app=getApp();
Page({
  data: {
    movies:[
      {url:'/image/text1.jpg'},
      {url:'/image/text.jpg'}
    ],
    indicatorDots: true,
    autoplay: true,
    interval: 5000,
    duration: 1000,
    userInfo: {},
    broadcastimglists: [],
  },

  onLoad: function (options) {
    this.data.page = 1;
    let that = this;
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Commodity/lists',
      data: {
        mall_id: 2,
        order:'shop_sale',
        page: this.data.page,
      },
      success: function (res) {
        console.log(res);
        var baokuan = res.data.data;
        that.setData({
          baokuan: baokuan,
        })
      }
    })
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Category/lists',
      data:{
        mall_id:2,
        pid:0
      },
      success:res=>{
        this.setData({
          category:res.data.lists
        })
      }
    })

    var broadcastimglists = [];
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Broadcastimg/lists',
      data: {
        class: "3",
      },
      success: function (res) {
        if (res.data.lists) {
          that.setData({
            broadcastimglists: res.data.lists,
          })
        }

      }
    })

  },
  toDetail:function(e){
    var id = e.currentTarget.dataset.id;
    wx.navigateTo({
      url: '/pages/detailedinfo/detailedinfo?id='+id,
    })
  },

  input:function(e){
    this.data.key = e.detail.value;
  },
  search:function(){
    if (this.data.key == undefined){
      this.data.key = '';
    }
    wx.navigateTo({
      url: "/pages/goodslist/goodslist?mall_id=2&key="+this.data.key,
    });
  },
  //去分类页面
  goclass: function (e) {
    wx.navigateTo({
      url: '/pages/detailedinfo/detailedinfo?id=' + e.currentTarget.dataset.st,
    });
  },
  lunbo1: function(){
    wx.navigateTo({
      url: "/pages/pintuan/pintuan",
    });
  },
  lunbo2: function () {
    wx.navigateTo({
      url: "/pages/xianshiqianggou/xianshiqianggou",
    });
  },
  lunbo3: function () {
    wx.navigateTo({
      url: "/pages/xianshimiaosha/xianshimiaosha",
    });
  },
  lingquyouhuijuan:function(){
    wx.navigateTo({
      url: "/pages/detailedinfo/detailedinfo",
    });
  },
  hongbaogonglue:function(){
    wx.navigateTo({
      url: "/pages/hongbaogonglue/hongbaogonglue",
    });
  },
  gomiaosha: function () {
    wx.navigateTo({
      url: "/pages/xianshimiaosha/xianshimiaosha",
    });
  },
  gofenlei: function (e) {
    var id = e.currentTarget.dataset.id;
    wx.navigateTo({
      url: "/pages/fenlei/fenlei?category_id=" + id,
    });
  },
  lunbo4:function(){
    wx.navigateTo({
      url: '/pages/xinpin/xinpin',
    })
  },
  
})