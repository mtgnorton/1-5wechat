import Vue from 'vue'
let data = {
  centerStatus: true,
  isPc : true,
  centerFlag: 'category',
  event:{
    changePostdirectory:'change-post-directory',
    openTorrent:'open-torrent',
  }
};
export default new Vue({
  data(){
   return data;
  }
})