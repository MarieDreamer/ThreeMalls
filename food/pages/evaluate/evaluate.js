// pages/evaluate/evaluate.js
Page({

  data: {
    tab:['全部','好评','中评','差评','有图'],
    select_tab:0,
    list:['0','1']
  },

  onLoad: function (options) {
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Evaluation/lists',
      data:{
        commodity_id:30
      },
      success:res=>{
        this.setData({
          list:res.data.data
        })
      }
    })
  },

  select_tab:function(e){
    var index = e.currentTarget.dataset.index;
    this.setData({
      select_tab:index
    })
  }

})