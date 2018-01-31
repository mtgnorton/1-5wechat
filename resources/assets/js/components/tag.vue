<template>
    <div class="tag-container">
        <li class="tag-wrapper" v-for="item in tags" @click="changePostDirectory(item.id)">
            <el-tag :type="item|randomColor">{{item.name}}</el-tag>
        </li>
    </div>
</template>

<script>
    import {getTags} from '../api'
    import Bus from '../bus'
  export default {
    data(){
      return {
        tags:[],
      }
    },
    mounted() {
    this.getTags();
    },
    filters:{
      randomColor(value)
      {
        let tags = ['success','info','warning','danger','' ];
        let random = Math.floor(Math.random() * tags.length + 1)-1;
        return tags[random];
      },

    },
    methods:{
      getTags(){
        getTags().then((res)=>{
        this.tags = res.data.data;
        })
      },
      changePostDirectory(id){
      this.$router.push({name:'post-directory-tag',params:{id:id}});
      }
    }
  }

</script>

<style>
    .tag-container{
        background: hsla(0,0%,100%,.2);
    }
    .tag-wrapper {
        display: inline-block;
        padding:10px 20px;
        /*border-bottom: 1px solid #dcdcdc;*/
        list-style: none;
        cursor:pointer;
        color: #ffffff;
        /*text-shadow: 1px 1px rgb(77, 77, 77);*/
    }
    .tag-wrapper>.el-tag{
        font-weight: bold;
        font-size:20px;
    }
    .tag-wrapper > .name{
        display:inline-block;
        margin-left: 10px;
        white-space: nowrap;
        text-overflow: ellipsis;
        text-shadow: 1px 1px rgba(77,77,77,.25);
        font-size:18px;
        font-weight: normal;

    }
    i{
        color: orange;
    }
    .tag-wrapper > .detail > .date-wrapper,.tag-wrapper{
        display: inline-block;
    }
    .tag-wrapper > .detail > .date-wrapper{
        margin-right: 60px;
    }
</style>

