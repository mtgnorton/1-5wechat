<template>
    <transition
            name="comments"
    >
<div class="comments-wrapper" :style="{width:rightWidth/2+'px',right:rightWidth/4+'px'}" v-if="show">
    <el-table
            height="300"
            :data="tableData"
            stripe
            style="width: 100%">
        <el-table-column
                prop="date"
                label="日期"
                width="180">
        </el-table-column>
        <el-table-column
                prop="name"
                label="姓名"
                width="180">
        </el-table-column>
        <el-table-column
                prop="address"
                label="地址">
        </el-table-column>
    </el-table>

</div>
    </transition>

</template>

<script>

    import Bus from '../bus.js';
  export default {
    props:['rightWidth'],
    data(){
      return{
        show:false,
        tableData: [{
          date: '2016-05-02',
          name: '王小虎',
          address: '上海市普陀区金沙江路 1518 弄'
        }, {
          date: '2016-05-04',
          name: '王小虎',
          address: '上海市普陀区金沙江路 1517 弄'
        }, {
          date: '2016-05-01',
          name: '王小虎',
          address: '上海市普陀区金沙江路 1519 弄'
        }, {
          date: '2016-05-03',
          name: '王小虎',
          address: '上海市普陀区金沙江路 1516 弄'
        }]
      }

    },
    mounted() {
    this.eventListners();
    },
    methods:{
      eventListners(){
        Bus.$on(Bus.event.commentsShow,()=>{
          this.show = !this.show;
          console.log(22);

        })
      }
    }
  }

</script>

<style scoped>

    .comments-wrapper{
        height:300px;
        box-shadow: 0 0 1px 0 rgba(0,0,0,.75);
        background: #fff;
        position: fixed;
        width:600px;
        bottom: 80px;
        right: 0;
        z-index:10;
    }
    .comments-enter-active {
        transition: all 0.4s ease;
    }
    .comments-leave-active {
        transition:all 0.4s ease;
    }
    .comments-enter,.comments-leave-to{
       height:0;
    }
    .comments-enter-to,.comments-leave{
        height:300px;
    }

</style>

<style>
    .comments-wrapper .el-table__header-wrapper{
        display:none;
    }
</style>

