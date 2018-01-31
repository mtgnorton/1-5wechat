import axios from 'axios';

import Promise from 'promise';

// axios 配置
axios.defaults.timeout = 8000;
let base = 'http://localhost:3000/api';


// http request 拦截器categories
axios.interceptors.request.use(
  config => {
    if (sessionStorage.getItem('token')) {
      config.headers.Authorization = 'Bearer ' + sessionStorage.getItem('token');
    }
    return config;
  },
  err => {
    return Promise.reject(err);
  }
);

// http response 拦截器
// axios.interceptors.response.use(
//   response => {
//     return response;
//   },
//   error => {
//     if (error.response) {
//       switch (error.response.status) {
//         case 401:
//           // 401 清除token信息并跳转到登录页面
//           sessionStorage.setItem('token', null)
//           if(router.currentRoute.fullPath == '/login') {
//             return error.response;
//           }
//           router.push({
//             path: '/login',
//             query: {redirect: router.currentRoute.fullPath}
//           })
//         case 422:
//           return error.response;
//       }
//     }
//
//     return Promise.reject(error.response.data)
//   }
// );

export const getCategories = () =>{ return axios.get(`${base}/categories`)};
export const getPost = params =>{ return axios.get(`${base}/post/${params}`)};
export const categoryPost = params =>{ return axios.get(`${base}/category_post/${params}`)};
export const getTags = params =>{ return axios.get(`${base}/tags`)};
export const tagPost = params =>{ return axios.get(`${base}/tag_post/${params}`)};
export const getTorrent = (keyword,page) =>{ return axios.get(`${base}/torrent/${keyword}/${page}`)};
// export const requestLogin = params => { return axios.post(`${base}/login`, params).then(res => res.data); };
//
// export const addArticle = params => { return axios.post(`${base}/articles`, params); };
//
// export const updateTag = params =>{ return axios.patch(`${base}/tags/${params.id}`,params)};
