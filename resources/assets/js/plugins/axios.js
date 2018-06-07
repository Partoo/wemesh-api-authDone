import Vue from 'vue'
import Axios from 'axios'
import store from '../vuex/store'
import {
    Loading, MessageBox
} from 'element-ui'

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    Axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

Axios.defaults.baseURL = '/api/v1/';
Axios.defaults.headers.common['Authorization'] = `Bearer ${JSON.parse(window.localStorage.getItem('token'))}`;
Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
Axios.defaults.headers.common.Accept = 'application/json';
Axios.defaults.headers.post = {
    'Content-Type': 'application/x-www-form-urlencoded'
};
Axios.defaults.timeout = 5000;


// loading实例
let loadingInstance;

Axios.interceptors.request.use(
    config => {
        loadingInstance = Loading.service({
            fullscreen: true,
            spinner: 'el-icon-loading',
            text: '数据加载中...'
        });
        return config
    }, error => {
        loadingInstance.close();
        return Promise.reject(error)
    });

Axios.interceptors.response.use(
    response => {
        loadingInstance.close();
        return response
    }, error => {
        loadingInstance.close();
        switch (error.response.status) {
            case 401: //401尝试刷新一次令牌，失败则退出登录
                // Axios.post('/auth/refresh')
                //     .then((response) => {
                //         store.dispatch('refreshToken', response.data);
                //     })
                //     .catch(() => {
                //         // store.dispatch('logout')
                //         console.log('need logout')
                //     });
                MessageBox({
                    title: '错误提示：',
                    // message: error.response.data.message,
                    message: '登录证书过期，需要重新登录',
                    type: 'error',
                    callback: () => {
                        store.dispatch('logout');
                    }
                });
                break;
            case 500:
                MessageBox({
                    title: '错误提示：',
                    message: error.response.data.message,
                    type: 'error',
                    callback: () => {
                        store.dispatch('logout');
                    }
                });
                break;
            case 422:
                MessageBox({
                    title: '提示：',
                    message: error.response.data.errors,
                    type: 'warning'
                });
                break;
            default:
                MessageBox({
                    title: '错误提示：',
                    message: error.response.data.errors,
                    type: 'error'
                })
        }
        return Promise.reject(error)
    }
);

// function uniform(response) {
//     if (response == null) {
//         MessageBox({
//             title: '错误提示：',
//             message: '无法连接到远程服务器，请联系管理员',
//             type: 'error',
//             callback: action => {
//                 store.dispatch('logout')
//             }
//         })
//     } else if (response.status === 401) {
//         store.dispatch('refreshToken')
//     } else if (response.status === 200 || response.status === 201) {
//         return response.data
//     } else if (response.status === 203) {
//         store.dispatch('logout')
//     } else {
//         MessageBox({
//             title: '错误提示：' + response.status,
//             // 适配不同需求，Laravel Request 默认返回 messages, Laravel 内核错误返回 message
//             message: response.data.messages == null ? response.data.message : response.data.messages,
//             type: 'error'
//         })
//     }
// }

// export default {
//     post(url, data) {
//         return Axios({
//             method: 'post',
//             url,
//             data: data
//         }).then((response) => {
//             return uniform(response)
//         })
//     },
//     get(url, params) {
//         return Axios({
//             method: 'get',
//             url,
//             params
//         }).then((response) => {
//             return uniform(response)
//         })
//     },
//     put(url, data) {
//         return Axios({
//             method: 'put',
//             url,
//             data: data
//         }).then((response) => {
//             return uniform(response)
//         })
//     },
//     delete(url) {
//         return Axios({
//             method: 'delete',
//             url
//         }).then((response) => {
//             return uniform(response)
//         })
//     }
// }

// Bind Axios to Vue.
Vue.$http = Axios;
Object.defineProperty(Vue.prototype, '$http', {
    get() {
        return Axios
    }
});
