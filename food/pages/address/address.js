// pages/addres/addres.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    address:[],
    delBtnWidth:180
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    if (options != undefined){
      this.data.select = options.select;
    }else{
      this.data.select = 0;
    }
    
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Address/lists',
      data: {
        mall_id: 1,
        userid: wx.getStorageSync('userid')
      },
      success: res => {
        for (var v in res.data.lists) {
          res.data.lists[v]['txtStyle'] = ''
        }
        this.setData({
          address: res.data.lists,
        })
      }
    })
  },

  edit:function(e){
    var id = e.currentTarget.dataset.id;
    var name = e.currentTarget.dataset.name;
    var province = e.currentTarget.dataset.province;
    var address = e.currentTarget.dataset.address;
    var phone = e.currentTarget.dataset.phone;
    var def = e.currentTarget.dataset.default;
    wx.navigateTo({
      url: '/pages/address_edit/address_edit?id=' + id + '&name=' + name + '&province=' + province + '&address=' + address + '&phone=' + phone + '&def=' + def,
    })
  },
  select_addr:function(e){
    if(this.data.select == 1){
      wx.setStorageSync('select_addr_id', e.currentTarget.dataset.id);
      wx.navigateBack({
      })
    }
  },
  onShow() {
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Address/lists',
      data: {
        mall_id: 1,
        userid: wx.getStorageSync('userid')
      },
      success: res => {
        for (var v in res.data.lists) {
          res.data.lists[v]['txtStyle'] = ''
        }
        this.setData({
          address: res.data.lists,
        })
      }
    })
  },
  add:function(){
    wx.navigateTo({
      url: '/pages/address_edit/address_edit?add=1'
    })
  },
  delItem:function(e){
    var id = e.currentTarget.dataset.id;
    var index = e.currentTarget.dataset.index;
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Address/deletefun',
      data:{
        id:id
      },
      success:res=>{
        this.data.address.splice(index, 1);
        this.setData({
          address: this.data.address
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
      var list = this.data.address;
      list[index]['txtStyle'] = txtStyle;
      //更新列表的状态
      this.setData({
        address: list
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
      var list = this.data.address;
      var del_index = '';
      disX > delBtnWidth / 2 ? del_index = index : del_index = '';
      list[index].txtStyle = txtStyle;
      //更新列表的状态
      this.setData({
        address: list,
        del_index: del_index
      });
    }
  },
})