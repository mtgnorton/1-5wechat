<template>
    <div>
        <li class="post-wrapper" v-for="item in Posts">
            <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
            <h3 class="name">
                <span> 分类{item}</span>
            </h3>

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
        text-shadow: 1px 1px rgb(77, 77, 77);
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

