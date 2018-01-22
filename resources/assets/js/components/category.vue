<template>
    <div>
        <li class="post-wrapper" v-for="item in categories"  @click="chooseCategory(item.id)">
            <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
            <h3 class="name">
                <span> {{item.title}}</span>
            </h3>

        </li>
    </div>
</template>

<script>
    import {getCategories,categoryPost} from '../api.js';
  export default {
    data(){
      return {
        categories:[],
      }
    },
    mounted() {
        getCategories().then((res)=>{
            this.categories = res.data;
        }).catch((error)=>{
          console.log(error);
        })
    },
    methods:{
      chooseCategory(id){

        this.$router.push({name:'post-directory',params:{id:id}});

      }
    }
  }

</script>

<style scoped>
    .post-wrapper {
        padding:10px 20px;
        border-bottom: 1px solid #dcdcdc;
        list-style: none;
        background: hsla(0,0%,100%,.2);
        color: #ffffff;
        text-shadow: 1px 1px rgb(77, 77, 77);
        cursor: pointer;
    }
    .post-wrapper > .name{
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
    .post-wrapper > .detail > .date-wrapper,.tag-wrapper{
        display: inline-block;
    }
    .post-wrapper > .detail > .date-wrapper{
        margin-right: 60px;
    }
</style>

