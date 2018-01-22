<template>
    <div>
    <li class="post-wrapper" v-for="item in posts">

        <h3 class="name">
            <i class="fa fa-book" aria-hidden="true" style="margin-right:15px" :style="{'color':currentBackground}"></i>
            <span> {{item.title}}</span>
        </h3>
        <div class="detail">
            <div class="date-wrapper">
                <i class="fa fa-calendar" :style="{'color':currentBackground}"></i>
                <span class="date">{{item.time}}</span>
            </div>
            <div class="tag-wrapper">
                <i class="fa fa-tag" aria-hidden="true" :style="{'color':currentBackground}"></i>
                <span class="tag" v-for="tag in item.tags">{{tag}}</span>
            </div>
        </div>
    </li>
    </div>
</template>

<script>
    import Bus from '../bus.js'
    import {categoryPost} from '../api.js'
  export default {
    data(){
      return {
        posts:[],
        currentBackground: this.cancelOpacity(sessionStorage.getItem('background')) || 'rgba(226, 187, 43)'
      }
    },
    mounted() {
      Bus.$on('switchBackground',(color)=>{

        this.currentBackground = this.cancelOpacity(color);
      });
        this.getData();
    },
    methods:{
      cancelOpacity (value){
        if(!value){
          return '';
        }
        let temp = value.split(',');
         temp[temp.length-1] ='1)';
         return  temp.join(',');

      },
      getData() {

        categoryPost(this.$route.params.id).then((res)=>{
          this.posts = res.data.data;

          console.log(this.posts);
          
      }).catch((error)=>{
          console.log(error);

      })
      }
    }
  }

</script>

<style  scoped>
    .post-wrapper {
        padding:10px 20px;
        border-bottom: 1px solid #dcdcdc;
        list-style: none;
        background: hsla(0,0%,100%,.2);
        color: #ffffff;
        overflow:hidden;
    }
    .post-wrapper > .name{
        display:inline-block;
        max-width: 350px;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #161717;;
        font-size:18px;
        font-weight: normal;
        white-space:nowrap;
        /*font-family: "Arial","Microsoft YaHei","黑体","宋体",sans-serif;*/
    }
    i{
        color: orange;

    }
    .post-wrapper > .detail > .date-wrapper,.tag-wrapper{
        display: inline-block;
        text-shadow: 1px 1px rgb(77, 77, 77);
    }
    .post-wrapper > .detail > .date-wrapper,.tag-wrapper>.tag {
    margin-right:5px;
    }
    .post-wrapper > .detail > .date-wrapper{
        margin-right: 60px;
    }
</style>

