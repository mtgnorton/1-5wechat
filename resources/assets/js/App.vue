<template>
    <div class="container" style="width: 100%;padding: 0px" :style="{height:cHeight+'px'}">
        <el-row>
            <el-col ref="left" :md="4">

                <left  :top-width="leftWidth" :c-height="cHeight" ></left>

            </el-col>


            <el-col :md="6">

                <center :c-height="cHeight" ></center>

            </el-col>

            <el-col :md="rightSpan" >

            <right :c-height="cHeight" ></right>

            </el-col>

        </el-row>
    </div>


</template>

<script>
  import Left from './components/Left.vue';
  import Center from './components/center.vue';
  import Right from './components/right.vue';
  import Bus from './bus.js';

  export default {
    data(){
      return {
      cHeight : 0, //总容器的高度
      leftWidth: 0, //左侧栏的宽度
      rightSpan: 14,
      }
    },
    components:{
      'left': Left,
      'center': Center,
      'right': Right
    },
    mounted() {
      this.setSize();
      Bus.isPc = this.isPc();
      
      window.onresize = this.setSize;
      Bus.$on('switchCenter',()=>{
        if(Bus.centerStatus){
          this.rightSpan = 14;
        }else{
          this.rightSpan = 20;
        }
      })
    },
    methods:{
      setSize() {
        if (window.innerHeight)
           this.cHeight = window.innerHeight;
        else if ((document.body) && (document.body.clientHeight))
           this.cHeight = document.body.clientHeight;
           this.leftWidth = document.getElementsByClassName('left-container')[0].clientWidth;

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
