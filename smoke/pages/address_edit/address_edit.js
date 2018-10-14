var model = require('../../model/model.js')
// pages/addres/addres.js

var show = false;
var item = {};

Page({
  data: {
    item: {
      show: show
    }
  },
  onLoad: function (options) {
    this.data.add = options.add;
    this.data.id = options.id;
    var name = options.name;
    var province = options.province;
    var address = options.address;
    var phone = options.phone;
    var def = '';
    if (options.def == 1){
      def = true;
    }else{
      def = false;
    }
    this.setData({
      name: name,
      province: province,
      address: address,
      phone: phone,
      def: def
    })
  },
  formSubmit:function(e){
    let { name, province, address, phone, def } = e.detail.value;
    if(this.data.add == 1){
      wx.request({
        url: 'http://wechat.threemall.jianfengweb.com/Address/adds_do',
        data:{
          name: name,
          province: province,
          address: address,
          phone: phone,
          default: def,
          userid:wx.getStorageSync('userid'),
          mall_id:3
        },
        success:res=>{
          wx.showToast({
            title: '添加成功',
            icon: 'success',
            duration: 2000,
            success: function () {
              wx.navigateBack({
              })
            }
          })
        }
      })
    }else{
      wx.request({
        url: 'http://wechat.threemall.jianfengweb.com/Address/modify_do',
        data:{
          id:this.data.id,
          name: name,
          province: province,
          address: address,
          phone: phone,
          default: def
        },
        success:res=>{
          wx.showToast({
            title: '修改成功',
            icon:'success',
            duration: 2000,
            success: function () {
              wx.navigateBack({
              })
            }
          })
        }
      })
    }
    
  },
  //生命周期函数--监听页面初次渲染完成
  onReady: function (e) {
    var that = this;
    //请求数据
    model.updateAreaData(that, 0, e);
  },
  //点击选择城市按钮显示picker-view
  translate: function (e) {
    model.animationEvents(this, 0, true, 400);
  },
  //隐藏picker-view
  hiddenFloatView: function (e) {
    model.animationEvents(this, 200, false, 400);
  },
  //滑动事件
  bindChange: function (e) {
    model.updateAreaData(this, 1, e);
    item = this.data.item;
    this.setData({
      province: item.provinces[item.value[0]].name,
      city: item.citys[item.value[1]].name,
      county: item.countys[item.value[2]].name
    });
  },
})