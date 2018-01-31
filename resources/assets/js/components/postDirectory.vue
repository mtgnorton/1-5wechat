<template>
    <div>
    <li class="post-wrapper" v-for="item in posts">

        <h3 class="name" @click="changePost(item.id)">

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
    import {categoryPost,tagPost} from '../api.js'
  export default {
    data(){
      return {
        posts:[],
        currentBackground: this.cancelOpacity(sessionStorage.getItem('background')) || 'rgba(226, 187, 43)'
      }
    },
    mounted() {
        this.eventListners();
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
      changePost(id){
        Bus.$emit('change-post-id',id);
      },
      getData() {
        let cP = categoryPost;
        let tP = tagPost;
        let functionName = "tP";
        if(_.includes(this.$route.path,'category'))
          functionName = 'cP';

        eval(functionName)(this.$route.params.id).then((res)=>{
          this.posts = res.data.data;

          console.log(this.posts);
          
         }).catch((error)=>{
          console.log(error);

      })
      },
      eventListners(){
        Bus.$on('switchBackground',(color)=>{

          this.currentBackground = this.cancelOpacity(color);
        });
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
        max-width: 350px;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #161717;;
        font-size:18px;
        font-weight: normal;
        white-space:nowrap;
        cursor: pointer;
        /*font-family: "Arial","Microsoft YaHei","黑体","宋体",sans-serif;*/
    }
    .post-wrapper > .name>span{
        display: inline-block;
        max-width: 300px;
    }
    i{
        color: orange;

    }
    .post-wrapper > .detail{
        white-space: nowrap;
    }
    .post-wrapper > .detail > .date-wrapper,.tag-wrapper{
        display: inline-block;
        text-shadow: 1px 1px rgb(77, 77, 77);
    }
    .post-wrapper > .detail > .date-wrapper,.tag-wrapper>.tag {
    margin-right:5px;
    }
    .post-wrapper > .detail > .date-wrapper{
        margin-right: 20px;
    }
</style>

