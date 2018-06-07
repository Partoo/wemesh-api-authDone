window._ = require('lodash');
window.Popper = require('popper.js').default;
//AXIOS
// window.axios = require('axios');
// window.axios.defaults.baseURL = '/api/v1/';
// window.axios.defaults.headers.common['Authorization'] = `Bearer ${JSON.parse(window.localStorage.getItem('token'))}`;
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// window.axios.defaults.headers.common.Accept = 'application/json';
// window.axios.defaults.headers.post = {
//     'Content-Type': 'application/x-www-form-urlencoded'
// };
//
// import {Loading, MessageBox} from 'element-ui'
// import store from './vuex/store'
//
// let token = document.head.querySelector('meta[name="csrf-token"]');
//
// if (token) {
//     window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
// } else {
//     console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
// }
//
// // create ElementUI Loading
// let loadingInstance;
// window.axios.interceptors.request.use(
//     config => {
//         loadingInstance = Loading.service({
//             fullscreen: true,
//             spinner: 'el-icon-loading',
//             background: 'rgba(0, 0, 0, .6)',
//             text: '数据加载中...'
//         });
//         return config
//     }, error => {
//         loadingInstance.close();
//         return Promise.reject(error)
//     }
// );
//
// window.axios.interceptors.response.use(
//     response => {
//         loadingInstance.close();
//         return response
//     }, error => {
//         loadingInstance.close();
//         switch (error.response.status) {
//             case 401:
//                 MessageBox({
//                     title: '错误提示：',
//                     message: '登录令牌过期，需要重新登录',
//                     type: 'error',
//                     callback: action => {
//                         store.dispatch('logout');
//                     }
//                 });
//             case 500:
//                 MessageBox({
//                     title: '错误提示：',
//                     message: error.response.message,
//                     type: 'error',
//                     callback: action => {
//                         // store.dispatch('logout');
//                     }
//                 });
//             default:
//                 MessageBox({
//                     title: '错误提示：',
//                     message: error.response.data.errors,
//                     type: 'error'
//                 })
//         }
//     }
// );


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
