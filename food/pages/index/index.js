// pages/indax/indax.js
Page({
  data: {
    tab:['首页','全部','拼购','促销','动态'],
    order_tab:['推荐','销量','新品','价格'],
    top_display:1,
    select_order:0,
    select_tab:0,
    price:0,
    page:1,
    list:[],
    broadcastimglists: [],
  },
  onLoad: function (options) {
    let that = this;
    var username = wx.getStorageSync('username');
    if (!username) {
      wx.navigateTo({
        url: '/pages/login/login',
      })
    }
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Coupon/lists',
      data: {
        user_id: wx.getStorageSync('userid'),
        mall_id: 1,
        user_id: wx.getStorageSync('userid')
      },
      success: res => {
        this.setData({
          coupon_list: res.data.data
        })
      },
    })
    var broadcastimglists = [];
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Broadcastimg/lists',
      data: {
        class: "1",
      },
      success: function (res) {
        if (res.data.lists){
          that.setData({
            broadcastimglists: res.data.lists,
          })
        }
      }
    })
  },
  toTop:function(e){
    if (wx.pageScrollTo) {
      wx.pageScrollTo({
        scrollTop: 0
      })
    } else {
      wx.showModal({
        title: '提示',
        content: '版本过低，无法使用该功能，请升级到最新微信版本后重试。'
      })
    }
  },
  select_tab:function(e){
    var index = e.currentTarget.dataset.index;
    this.data.page = 1;
    this.data.list = [];
    this.setData({
      select_tab:index
    })
    //拼购
    if(index == 2){
      this.data.is_spell_group = 1
      this.commodity_list();
    }else{
      this.data.is_spell_group = 2
    }
    //全部
    if (index == 1){
      this.commodity_list();
    }
    //促销
    if (index == 3) {
      this.data.select_order = 2;
      this.commodity_list();
    }
    //动态
    if(index == 4){
      this.data.select_order = 2;
      this.commodity_list();
    }
  },
  select_order:function(e){
    var index = e.currentTarget.dataset.index;
    this.setData({
      select_order:index
    })
    this.data.page = 1;
    this.data.list = [];
    var f = '';
    if (index == 3){
      var price = this.data.price;
      if (price == 0 || price == 2){
        f = 1
      } else if (price == 1){
        f = 2
      }
    }else{
      f = 0
    }
    this.setData({
      price:f
    })
    this.commodity_list();
  },
  commodity_list:function(){
    var index = this.data.select_order;
    var order = '';
    switch (index){
      case 0:
        order = 'id'; break;
      case 1:
        order = 'shop_sale'; break;
      case 2:
        order = 'create_time'; break;
      default:
        order = 'shop_price'; break;
    }
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Commodity/lists',
      data: {
        mall_id: 1,
        page: this.data.page,
        order:order,
        is_spell_group:this.data.is_spell_group,
        price_order:this.data.price
      },
      success: res=> {
        if (res.data.data){
          var list = this.data.list;
          list = list.concat(res.data.data);
          this.setData({
            list: list,
          })
        }
        
      }
    })
  },
  onReachBottom: function () {
    this.data.page++;
    this.commodity_list();
  },
  //搜索
  SearchInput: function (e) {
    var key = e.detail.value;
    let that = this;
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Commodity/lists',
      data: {
        mall_id: 1,
        page: 1,
        key: key,
      },
      success: function (res) {
        var list = res.data.data;
        if(list){
          that.setData({
            list:list,
            select_tab: 1
          })
        }else{
          wx.showToast({
            icon: 'none',
            title: "暂无相关商品",
            duration: 1000,
          })
        }
      }
    })

  },

  onPageScroll: function (e) {
    var a = '';
    e.scrollTop > 100 ? a = 0 : a = 1;
    this.setData({
      top_display: a
    })
  },
  
  
  getCoupon:function(e){
    if(e.currentTarget.dataset.has_get == 0){
      var id = e.currentTarget.dataset.id;
      var index = e.currentTarget.dataset.index;
      wx.request({
        url: 'http://wechat.threemall.jianfengweb.com/CouponUser/getCoupon',
        data:{
          mall_id: 1,
          user_id:wx.getStorageSync('userid'),
          coupon_id:id
        },
        success:res=>{
          if(res.data.status){
            this.data.coupon_list[index]['has_get'] = 1;
            this.setData({
              coupon_list: this.data.coupon_list
            })
          }
          
        }
      })
    }
    
  },

  gocommodity: function (e) {
    console.log(e.currentTarget.dataset.id);
    wx.navigateTo({
      url: '/pages/pintuan/pintuan?id=' + e.currentTarget.dataset.id,
    });
  },

  //去分类页面
  goclass: function () {
    wx.navigateTo({
      url: "/pages/class/class",
    });
  },
  
})