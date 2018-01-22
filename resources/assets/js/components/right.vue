<template>
    <transition
            name="custom-classes-transition"
            enter-active-class="animated fadeInRight"
            leave-active-class="animated fadeOutRight"

    >

    <div class="right-wrapper"  :style="{height:cHeight+'px'}" v-show="showAnimation">
        <div class="right" ref="sHeight">
            <div class="right-header">
               <h2> Hello World</h2>
                <div class="switch-read">
                    <el-switch
                            v-model="isRead"
                            active-text="阅读模式"
                            inactive-text="浏览模式"
                            @change="switchRead(isRead)"
                    >
                    </el-switch>
                </div>


            </div>
            <div class="content  w-e-text-container" :style="{'background-color':currentBackground}">
                <div class="read w-e-text" :style="readCompute"  v-html="post.content"></div>
            </div>
        </div>
    </div>
    </transition>
</template>

<script>
    import Bus from '../bus.js'
    import {getPost} from '../api.js'

    export default {
    props:['cHeight','isShow'],

    data(){
      return {
        currentBackground: sessionStorage.getItem('background') || 'rgba(226, 187, 43,0.2)',
        showAnimation:true,
        post:{
        },
        isRead:false
      }
    },

    watch:{
      isShow(){
        this.showAnimation = false;
        this.$nextTick(function () {
          this.showAnimation= true;
        })
      }
    },
    computed:{
      readCompute(){
        if (this.isRead){
          return {
            margin: '0 15%'
          }
        }

      }
    },
    mounted() {
      Bus.$on('switchBackground',(color)=>{
        this.currentBackground = color
      });

      getPost(4).then((res)=>{

        if(res.data.status == true){
        this.post = Object.assign({},this.post,res.data.data);
        }
      }).catch((res)=>{

        
      })
    },
    
    methods:{
    switchRead(value){
    this.isRead = value;
    Bus.$emit('read',value);
    }
    }
  }

</script>

<style>

.right-wrapper{


    overflow-y: auto;
    /*background: linear-gradient(200deg, #e2be7a, #e2be7a);*/

}

    .right{
        overflow: auto;
    }
    .right >.right-header{
        position: relative;
        height:100px;
        background: #a0cfe4;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 6px 0 rgba(0,0,0,.75);
        color:#fff
    }
    .right >.right-header>h2{
        margin: 0;
    }

    .right >.right-header>.switch-read{
        position: absolute;
        right:0;
        bottom: 0;
        margin-bottom: 10px;
    }
    .right>.content{

        background: rgba(226, 187, 43,0.2);
        padding:20px 100px;
        line-height: 30px;
    }

.right>.content pre{

    margin: 20px 0;

    border: 1px solid #ccc;
    border-radius: 4px;
}
    .right>.content code{
        padding: 20px 0;
    }
.el-switch__input:focus~.el-switch__core {
    outline:#fff solid 0;
}
    .el-switch__label--left>span{
        color:#fff
    }
    .el-switch__label--right>span{
        color:#ddd;
    }
</style>

