<template>
<div class="footer-wrapper" :style="{width:rightWidth+'px'}">
  <el-container> 
    <el-main >
    <el-row>
      <el-col :md="12" :offset="2">
       <el-input
       :autosize="{ minRows: 2, maxRows: 2}"
        type="textarea"
        :rows="2"
        placeholder="请输入评论"
        v-model="textarea">
      </el-input>
      </el-col>
      <el-col :md="2" :offset="1"  class="pub-comment">
  <el-button size="small"  plain>发表评论</el-button>
      </el-col>

      <el-col :md="2" :offset="1" class="access-comment">
       <el-badge :value="12" class="item">
  <el-button size="small" @click="accessComments">查看评论</el-button>
    </el-badge>
    </el-col>

      <el-col :md="2" :offset="1"  class="pub-comment">
  <el-button size="small" @click="registerOrLogin" plain>注册/登陆</el-button>
      </el-col>
    </el-row>
 
    </el-main>
   </el-container>  
</div>
</template>

<script>
    import Bus from '../bus.js';

    export default {
      props:['rightWidth'],
      data(){
        return {
          textarea:''
        }
      },
      mounted() {

      },
      components:{
      },
      methods:{
        accessComments(){
          Bus.$emit(Bus.event.commentsShow);
        },
        registerOrLogin(){
          Bus.$emit(Bus.event.userShow);
        }

      }
    }

</script>

<style scoped>
.footer-wrapper{
height:80px;
box-shadow: 0 0 1px 0 rgba(0,0,0,.75);
background: #b3c0d1;
position: fixed;
bottom: 0;
right: 0;
    z-index:100;
}

.pub-comment{
margin-top: 10px
}
.item{
    padding : 0;
    margin-top:10px;
}

</style>

