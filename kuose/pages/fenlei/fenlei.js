// pages/fenlei/fenlei.js
Page({

  data: {
    select_bar:0,
    list:[]
  },
  onLoad: function (options) {
    this.data.main_class = options.category_id;
    this.data.page = 1;
    // var main_class = 33;
    this.requestList();
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Category/lists',
      data:{
        mall_id:2,
        pid:0
      },
      success:res=>{
        this.setData({
          bar:res.data.lists
        })
      }
    })
  },

  select_bar:function(e){
    var index = e.currentTarget.dataset.index;
    var main_class = this.data.bar[index]['id']
    this.setData({
      select_bar:index
    })
    this.requestList(main_class);
    
  },
  requestList:function(){
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Commodity/lists',
      data: {
        mall_id: 2,
        main_class: this.data.main_class,
        order:'create_time',
        page:this.data.page
      },
      success: res => {
        if (res.data.data){
          this.data.list = this.data.list.concat(res.data.data)
        }
        this.setData({
          list: this.data.list
        })
      }
    })
  },
  godetailedinfo: function (e) {
    wx.navigateTo({
      url: '/pages/detailedinfo/detailedinfo?id=' + e.currentTarget.dataset.id,
    })
  },
  onReachBottom: function (e) {
    this.data.page ++;
    this.requestList();
  }
})