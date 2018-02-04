import Vue from 'vue'
const data = {
  centerStatus: true,
  isPc : true,
  centerFlag: 'category',
  event:{
    changePostdirectory:'change-post-directory',
    openTorrent:'open-torrent',
    commentsShow:'comments-show',
    userShow:'user-show'
  }
};
const funs = {
  getErrorMsg:function (errors) {
    let msgs = '';
     errors  = errors['response']['data']['errors'];
    for(let msg in errors){

      errors[msg].forEach(value=>{
        msgs += value+'  ';
      })
    }
    return msgs;
  }
}
export{
  funs
}
export default new Vue({
  data(){
   return data;
  }
})