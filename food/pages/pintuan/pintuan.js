// pages/pintuan/pintuan.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    mynum:1,
    num2:'1',
    select_type:0,
    animationData: '',
    animationData2: '',
    showModalStatus: '',
    showModalStatus2: '',
  },
  onLoad: function (options) {
    if (options.group_id != undefined) {
      this.data.group_id = options.group_id;
    } else {
      this.data.group_id = ''
    }
    var id = options.id;
    // var id = 30;
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Commodity/listsfind',
      data: {
        id: id,
      },
      success: res => {
        this.setData({
          goods:res.data.data,
          selected_bar: 0,
          group_id: this.data.group_id
        })
        if (res.data.data['is_spell_group'] == 1) {
          this.setData({
            remain_time: res.data.data['spell']
          })
          this.timing();
        }
      }
    })
  },
  
  goCart:function(){
    wx.switchTab({
      url: '/pages/shoppingcart/shoppingcart',
    })
  },
  adds: function () {
    var index = this.data.select_type;
    if (this.data.goods['food_type'] && this.data.mynum < this.data.goods['food_type'][index]['num']) {
      this.setData({
        mynum: ++this.data.mynum
      })
    }
    if (!this.data.goods['food_type'] && this.data.mynum < this.data.goods['shop_num']){
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
  //切换规格，更新数量和价格
  select_type:function(e){
    var index = e.currentTarget.dataset.index;
    var myprice = this.data.size[index]['price'];
    if(this.data.buy_type >= 1){
      myprice = this.data.goods['spell']['group_price']
    }
    this.setData({
      select_type: index,
      mynum:1,
      myprice: myprice
    })
  },
  //下一步 对话框
  showModal_next: function (e) {
    var buy = e.currentTarget.dataset.buy;
    this.data.buy_type = e.currentTarget.dataset.buy_type;
    if(e.currentTarget.dataset.spell == 1){
      this.data.myprice = this.data.goods['spell']['group_price'];
    }else{
      this.data.myprice = this.data.goods['shop_price'];
    }
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Size/getType',
      data:{
        commodity_id: this.data.goods['id']
      },
      success:res=>{
        this.setData({
          size:res.data.data,
          select_type: 0,
          mynum : 1
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
          showModalStatus: true,
          buy: buy
        })
        setTimeout(function () {
          animation.translateY(0).step()
          this.setData({
            animationData: animation.export()
          })
        }.bind(this), 200)
      }
    })
  },
  
  add_cart:function(){
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Cart/adds_do',
      data: {
        user_id: wx.getStorageSync('userid'),
        mall_id: 1,
        commodity_id: this.data.goods['id'],
        type_id: this.data.size[this.data.select_type]['id'],
        num: this.data.mynum,
      },
      success: res => {
        if(res.data.status == 1){
          wx.showToast({
            title: '添加成功',
            icon: 'succes',
            mask: true,
            duration: 1000
          })
          this.hideModal();
        }
      }
    })
  },
  to_buy: function (e) {
    if(this.data.buy_type >= 1){
      this.data.myprice = this.data.goods['spell']['group_price'];
    }
    var goods = {
      commodity_id: this.data.goods['id'],
      commodity_image: this.data.goods['shop_index_image'][0],
      commodity_name: this.data.goods['shop_name'],
      price: this.data.myprice,
      type: this.data.size[this.data.select_type]['type'],
      num: this.data.mynum
    }
    goods = JSON.stringify(goods);
    wx.navigateTo({
      url: '/pages/queren/queren?goods=' + goods + '&buy_type=' + this.data.buy_type + '&group_id=' + this.data.group_id,
    })
  },
  //单独购买 对话框
  showModal_singebuy: function (e) {
    this.data.buy_type = 0;
    if (e.currentTarget.dataset.spell == 1) {
      this.data.myprice = this.data.goods['spell']['group_price'];
    } else {
      this.data.myprice = this.data.goods['shop_price'];
    }
    wx.request({
      url: 'http://wechat.threemall.jianfengweb.com/Size/getType',
      data: {
        commodity_id: this.data.goods['id']
      },
      success: res => {
        this.setData({
          size: res.data.data,
          select_type: 0,
          mynum: 1
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
          animationData2: animation.export(),
          showModalStatus2: true
        })
        setTimeout(function () {
          animation.translateY(0).step()
          this.setData({
            animationData2: animation.export()
          })
        }.bind(this), 200)
      }
    })
  },
  //隐藏对话框
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
  hideModal2: function () {
    // 隐藏遮罩层
    var animation = wx.createAnimation({
      duration: 200,
      timingFunction: "linear",
      delay: 0
    })
    // 隐藏弹出框2
    this.animation = animation
    animation.translateY(300).step()
    this.setData({
      animationData2: animation.export(),
    })
    setTimeout(function () {
      animation.translateY(0).step()
      this.setData({
        animationData2: animation.export(),
        showModalStatus2: false
      })
    }.bind(this), 200)
  },
  
  bindManual: function (e) {
    var num = e.detail.value;
    // 将数值与状态写回
    this.setData({
      num2: num
    });
  },
  goevaluate:function(){
    wx.navigateTo({
      url: '/pages/evaluate/evaluate?commodity_id='+this.data.goods.id,
    })
  },
  onShareAppMessage: function () {
    var id = this.data.goods['id'];
    var group_id = '';
    if (this.data.goods['spell']){
      group_id = this.data.goods['spell']['id'];
    }
    return {
      title: '参与拼团',
      path: '/page/detailedinfo/detailedinfo?id=' + id + '&group_id=' + group_id
    }
  },

  timing: function () {
    var that = this;
    var remain_time = this.data.remain_time;
    if (remain_time['day'] == 0 &&
      remain_time['hour'] == 0 &&
      remain_time['minute'] == 0 &&
      remain_time['second'] == 0) {
    } else {
      var time = setTimeout(function () {
        if (remain_time['second'] > 0) {
          remain_time['second']--;
        } else {
          remain_time['second'] = 59;
          if (remain_time['minute'] > 0) {
            remain_time['minute']--;
          } else {
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
  
})