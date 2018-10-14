Page({
  data: {
  
  },
  onLoad: function (options) {
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Commodity/lists',
      data:{
        mall_id:2,
        is_spell_group:1
      },
      success:res=>{
        this.setData({
          list:res.data.data
        })
      }
    })
  },
  goinfo: function (e) {
    var id = e.currentTarget.dataset.id;
    wx.navigateTo({
      url: "/pages/detailedinfo/detailedinfo?id="+ id,
    });
  },
})