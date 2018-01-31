import VueRouter from 'vue-router'

const path = './components/';
const routes = [
  {
    path:'/',
    redirect:'/categories'
  },
  {
    path:'/categories',
    component: require(`${path}category`),
    name:'categories',
  },
  {
    path:'/tags',
    component: require(`${path}tag`),
    name:'tags',
  },
  {
    path:'/post-directory/category/:id',
    component: require(`${path}postDirectory`),
    name:'post-directory',
  },
  {
    path:'/post-directory/tag/:id',
    component: require(`${path}postDirectory`),
    name:'post-directory-tag',
  }

];
const router = new VueRouter({
  mode: 'hash',
  base: __dirname,
  routes
});


export default router;

