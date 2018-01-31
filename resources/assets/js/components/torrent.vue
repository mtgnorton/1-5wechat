<template>
<div>
  <el-dialog title="搜索" :visible.sync="dialogTableVisible" width="80%">
  <div class="search-input">
  <el-input
    placeholder="请输入内容"
    v-model="keyword"
    @keyup.enter.native="getData"
    clearable>
 <el-button slot="append" icon="el-icon-search" @click="getData"></el-button>
  </el-input>
  </div>
 

  <div class="block" style="margin-top:30px">



  <el-table :data="gridData" height="350"  v-loading="loading" v-if="gridData" border :row-class-name="tableRowClassName">
    <el-table-column property="0" label="名称" ></el-table-column>
    <el-table-column property="1" label="大小" width="150"></el-table-column>
    <el-table-column property="2" label="日期" width="200"></el-table-column>
    <el-table-column property="xl" width="200" label="下载">
        <template slot-scope="scope">
        <el-button @click="download(scope.row)" type="text" size="small">下载</el-button>
      </template>
    </el-table-column>
  </el-table>

    <el-pagination style="margin-top: 10px" background v-if="total"
    @current-change="changePage"
    layout="prev, pager, next"
    :page-size="20"
    :total="total">
  </el-pagination>
  </div>





</el-dialog>

</div>


</template>

<script>
import Bus from '../bus.js';
import {getTorrent} from '../api.js';
  export default {
    data() {
      return {
        gridData: '',
        keyword:'',
        dialogTableVisible: false,
        page:1,
        total: 0,
        loading:false
      };
    },
    mounted(){
    Bus.$on(Bus.event.openTorrent,()=>{
      this.dialogTableVisible = !this.dialogTableVisible;
    })
    },
    methods:{
      getData(){
        this.loading =true;
        this.gridData = ['1'];
        getTorrent(this.keyword,this.page).then((res)=>{
           this.$notify({
          title: '成功',
          message: '查询成功',
          type: 'success',
          duration:2000
          });
            this.gridData = res.data.data.table;
           this.total = res.data.data.page*20;
           this.loading =false;

        }).catch((error)=>{
          this.loading = false;
          this.gridData = '';
          this.$notify.error({
          title: '错误',
          message: '查询超时',
          duration:2000
          
        });
        })
      },
     tableRowClassName({row, rowIndex}) {
      let colorMap = ['hd','1080','720'];
      let name = row[0].toLowerCase();
      let flag = '';
      colorMap.forEach(function(item){
         
        if (name.indexOf(item) !== -1) {
      
          flag =  'success-row';
          return;
        }
      })
     return flag;
      },
      changePage(val){
        this.page = val;
        this.getData();
      },
      download(val){
         console.log(JSON.parse(JSON.stringify(val)))
          window.open(val.xl);
      }
    }
  };
</script>

<style>

  .el-table .success-row {
    background: oldlace;
  }
</style>

