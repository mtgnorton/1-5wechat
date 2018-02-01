<template>
    <div class="container" style="width: 100%;padding: 0px" :style="{height:cHeight+'px'}">
        <el-row>
            <el-col ref="left" :md="4" v-if="leftShow">

                <left  :top-width="leftWidth" :c-height="cHeight" ></left>

            </el-col>


            <el-col :md="6">

                <center :c-height="cHeight" :is-show="centerShow"></center>

            </el-col>

            <el-col :md="rightSpan" >

            <right :c-height="cHeight" :right-width="rightWidth" :is-show="centerShow"></right>
            
            </el-col>

        <torrent></torrent>
        </el-row>
    </div>


</template>

<script>
  import Left from './components/Left.vue';
  import Center from './components/center.vue';
  import Right from './components/right.vue';
  import Torrent from './components/torrent.vue';
  import Bus from './bus.js';

  export default {
    data(){
      return {
      cHeight : 0, //总容器的高度
      leftWidth: 0, //左侧栏的宽度
      rightWidth: 0,//右侧栏的宽度
      rightSpan: 14,
      centerShow:  Bus.centerStatus,
      leftShow: true,

      }
    },
    components:{
      'left': Left,
      'center': Center,
      'right': Right,
      'torrent':Torrent
    },
    mounted() {

//      this.setToken()
      this.setSize();
      Bus.isPc = this.isPc();
      window.onresize = this.setSize;
      this.setEvent();

    },
    methods:{
      setSize() {
        if (window.innerHeight)
           this.cHeight = window.innerHeight;
        else if ((document.body) && (document.body.clientHeight))
           this.cHeight = document.body.clientHeight;
           this.leftWidth = document.getElementsByClassName('left-container')[0].clientWidth;
           this.rightWidth = document.getElementsByClassName('right-wrapper')[0].clientWidth;
          
      },

       isPc(){
        let userAgentInfo = navigator.userAgent;
        let Agents = ["Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod"];
        let flag = true;
        for (let v = 0; v < Agents.length; v++) {
          if (userAgentInfo.indexOf(Agents[v]) > 0) {
            flag = false;
            break;
          }
        }

        return flag;
      },
      setToken(){
        let token = document.getElementsByTagName('meta')['csrf-token'].content;
        sessionStorage.setItem('token',token);
        
      },
      setEvent(){
        Bus.$on('switchCenter',(flag)=>{

          if ( Bus.centerFlag  == flag)
        {
          this.centerShow = Bus.centerStatus= false;
          Bus.centerFlag = '';
          this.rightSpan = 20;
        }else{
          this.centerShow = Bus.centerStatus= true;
          Bus.centerFlag = flag;
          this.rightSpan = 14;

        }
        this.centerFlag = flag;
    this.$nextTick(function(){
        this.rightWidth = document.getElementsByClassName('right-wrapper')[0].clientWidth;
        })
      })

        Bus.$on('read',(value)=>{
    
        if(value){ //如果是阅读模式
          this.leftShow = false;
          this.centerShow = false;
          this.rightSpan = 24;

        }else{
          this.leftShow = true;
          this.centerShow = true;
          this.rightSpan = 14;
        }
        this.$nextTick(function(){
        this.rightWidth = document.getElementsByClassName('right-wrapper')[0].clientWidth;
        })
      
      })
      }
  }
  }

</script>


<style>

    .container{

    }
    .text {
        font-size: 14px;
    }

    .item {
        padding: 18px 0;
    }

    .box-card {
        width: 480px;
    }
</style>
