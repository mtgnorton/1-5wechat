<template>
    <div class="tag-container">
        <li class="tag-wrapper" v-for="item in Posts">
            <el-tag :type="item|randomColor">标签一</el-tag>
        </li>
    </div>
</template>

<script>
  export default {
    data(){
      return {
        Posts:[1,2,3,4,5,1,1,1,1,1,1,1,1],
      }
    },
    mounted() {

    },
    filters:{
      randomColor(value)
      {
        let tags = ['success','info','warning','danger','' ];
        let random = Math.floor(Math.random() * tags.length + 1)-1;
        return tags[random];
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

