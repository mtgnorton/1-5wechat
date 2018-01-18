<template>
    <div>
    <li class="post-wrapper" v-for="item in Posts">
        <i class="fa fa-book" aria-hidden="true" :style="{'color':currentBackground}"></i>
        <h3 class="name">
            <span> 凌冬将至</span>
        </h3>
        <div class="detail">
            <div class="date-wrapper">
                <i class="fa fa-calendar" :style="{'color':currentBackground}"></i>
                <span class="date">2017-12-19</span>
            </div>
            <div class="tag-wrapper">
                <i class="fa fa-tag" aria-hidden="true" :style="{'color':currentBackground}"></i>
                <span class="tag">旧事</span>
                <span class="tag">前端</span>
            </div>
        </div>
    </li>
    </div>
</template>

<script>
    import Bus from '../bus.js'
  export default {
    data(){
      return {
        Posts:[1,2,3,4,5,1,1,1,1,1,1,1,1],
        currentBackground: this.cancelOpacity(sessionStorage.getItem('background')) || 'rgba(226, 187, 43)'
      }
    },
    mounted() {
      Bus.$on('switchBackground',(color)=>{
        console.log(this.cancelOpacity(color));

        this.currentBackground = this.cancelOpacity(color);
      })
    },
    methods:{
      cancelOpacity (value){
        let temp = value.split(',');
         temp[temp.length-1] ='1)';
         return  temp.join(',');

      }
    }
  }

</script>

<style>
    .post-wrapper {
        padding:10px 20px;
        border-bottom: 1px solid #dcdcdc;
        list-style: none;
        background: hsla(0,0%,100%,.2);
        color: #ffffff;

    }
    .post-wrapper > .name{
        display:inline-block;
        margin-left: 10px;
        white-space: nowrap;
        text-overflow: ellipsis;
        color: #161717;;
        font-size:18px;
        font-weight: normal;
        font-family: "Arial","Microsoft YaHei","黑体","宋体",sans-serif;

    }
    i{
        color: orange;

    }
    .post-wrapper > .detail > .date-wrapper,.tag-wrapper{
        display: inline-block;
        text-shadow: 1px 1px rgb(77, 77, 77);
    }
    .post-wrapper > .detail > .date-wrapper{
        margin-right: 60px;
    }
</style>

