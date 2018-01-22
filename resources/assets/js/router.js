import VueRouter from 'vue-router'

const path = './components/';
const routes = [
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
    path:'/post-directory/:id',
    component: require(`${path}postDirectory`),
    name:'post-directory',
  }
];
const router = new VueRouter({
  mode: 'hash',
  base: __dirname,
  routes
});


export default router;

