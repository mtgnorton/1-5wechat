<template>

<div class="left-container" v-show="isShow">
    <div class="top" :style="{height:cHeight/4+'px','background-color':currentBackground}"  >
        <div class="avatar" :style="{left:avatarLeft}">
            <img class="avatar-img" src="avatar.jpg" alt="">
        </div>
    </div>
    <div class="content"  :style="{height:cHeight/4*3+'px'}">
        <h2 class="name">mtg</h2>
        <p class="description">人生自古谁无死,人生自古谁无死,留取丹心照汗青</p>
        <div class="category">
            <ul>
                <li @click="openCenter('categories')">分类</li>
                <li @click="openCenter('tags')">标签</li>
                <li>个人简介</li>
                <li @click="openTorrent">torrent</li>
                <li class="choose-background">
                        <el-dropdown @command="chooseBackground">
                            <el-button >
                                选择背景
                            </el-button>
                            <el-dropdown-menu slot="dropdown">
                                <el-dropdown-item v-for="value,key in backgroundColors" :key="key" :command="value">{{key}}</el-dropdown-item>
                            </el-dropdown-menu>
                        </el-dropdown>
                </li>
            </ul>
        </div>
    </div>

</div>
</template>

<script>

    import Bus from '../bus.js';
  export default {
    props : [
      'cHeight',
      'topWidth'
    ],
    data(){
      return {
        isShow:true,
        backgroundColors:{
          '黄色':'rgba(226, 187, 43,0.2)',
          '绿色': 'rgba(35, 105, 43, 0.2)',
          '蓝色':'rgba(43, 158, 226, 0.2)',
          '红色':'rgba(226, 43, 136, 0.2)'
        },
        currentBackground: sessionStorage.getItem('background') || 'rgba(226, 187, 43,0.2)'
      }
    },
    computed:{
      avatarLeft(){
        return this.topWidth/2-64+'px';
      }
    },
    mounted() {

    },
    methods:{
      openCenter($flag){
        if (!Bus.isPc){
          this.isShow =false;
        }
        Bus.$emit('switchCenter',$flag);
        this.$router.push('/'+$flag);
      },
      openTorrent(){
        Bus.$emit(Bus.event.openTorrent);
      },
      chooseBackground(value){
        this.currentBackground = value;
        sessionStorage.setItem('background',value);
        Bus.$emit('switchBackground',value);
      }
    }
  }

</script>

<style>
    .left-container{
        /*min-width:200px;*/
        box-shadow: 0 0 6px 0 rgba(0,0,0,.75);
    }
    .left-container>.top{
    height:100px;
    background: #1b7e5a;
        position: relative;
}
    .left-container>.top>.avatar{
        display: block;
        border: 5px solid #fff;
        border-radius: 300px;
        width: 128px;
        height: 128px;
        margin: 0 auto;
        position: absolute;
        overflow: hidden;
        background: #88acdb;
        text-align: center;
        bottom: -64px;

    }
    .left-container>.top>.avatar>.avatar-img{
        border-radius: 300px;
        opacity: 1;
        -webkit-transition: all .2s ease-in;
        width:128px;
        height:128px;
    }
    .left-container>.content{
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-direction: column;
    }
    .left-container>.content>.name{
        margin-top: 100px;
        flex: 0 1 70px;
        font-size: 30px;
        font-family: Roboto,serif;
        color:#b0a0aa;

    }
    .left-container>.content>.description{
        word-wrap:break-word;
        color: #999;
        font-size: 14px;
        line-height: 17px;
        overflow: hidden;
        padding: 0 15px;
        /*省略号*/
        text-overflow: ellipsis;
        /*字间距*/
        letter-spacing: 1px;
        flex: 0 1 40px;
    }
    .left-container>.content>.category{
        flex: 0 1 auto;
        font-weight: 300;
        line-height: 31px;
        text-align: center;

    }
    .left-container>.content>.category>ul{
        padding-left:0;
    }
    .left-container>.content>.category>ul>li{
        list-style:none;
        cursor:pointer;
    }
    .left-container>.content>.category>ul>.choose-background{
      margin-top:20px

    }
</style>

