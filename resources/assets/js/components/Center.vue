<template>
    <transition
            name="custom-classes-transition"
            enter-active-class="animated bounceIn"
            leave-active-class="animated bounceOut"
            :duration="{ leave: 200 }"
    >
    <div class="center-wrapper" :style="{height:cHeight+'px'}" v-if="isShow">
<ul class="center">
    <transition
            name="custom-classes-transition"
            enter-active-class="animated slideInDown"
            leave-active-class="animated slideOutDown"
            mode="out-in"
    >
     <component :is="view"></component>
    <!--<post-directory v-if="centerFlag == 'category'"></post-directory>-->
     <!--<tag v-if="centerFlag == 'tag'"></tag>-->

    </transition>



</ul>

    </div>
    </transition>
</template>

<script>
  import Bus from '../bus.js';
  import postDirectory from './postDirectory.vue'
  import tag from './tag.vue'
  export default {
    props:['cHeight','isShow'],
    data(){
      return {
        Posts:[1,2,3,4,5,1,1,1,1,1,1,1,1],
        loading:false,

        centerFlag: Bus.centerFlag,

      }
    },
    components:{
      postDirectory,
      tag
    },
    computed:{
      view () {
        return this.centerFlag == "category" ?　'post-directory' : 'tag';
      }
    },
    mounted() {
        Bus.$on('switchCenter',($flag)=>{

          this.centerFlag = $flag;

        })
    },
    methods: {
      fetchData() {

      }
    },
  }

</script>

<style>
    .center-wrapper{
        overflow-y: auto;
        background: linear-gradient(200deg,#a0cfe4,#e8c37e);
    }
    .center{
        padding: 0 30px;
        min-width:250px;
        overflow: hidden;
    }

    ::-webkit-scrollbar
     {
        display: none;
         width: 3px;
         height: 16px;
         background-color: #F5F5F5;
     }
    /*定义滚动条轨道 内阴影+圆角*/
    ::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    /*定义滑块 内阴影+圆角*/
    ::-webkit-scrollbar-thumb
    {
        border-radius: 8px;
        background-color: rgba(0,0,0,.2);
    }


</style>

