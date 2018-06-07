import Dashboard from './pages/layouts/Dashboard.vue'
import Auth from './pages/layouts/Auth.vue'

export default [
    {
        path: '/auth',
        component: Auth,
        beforeEnter: guest,
        children: [
            {
                path: '/login',
                name: 'login',
                component: require('./pages/auth/Login')
            },
            {
                path: '/reset',
                name: 'reset',
                component: require('./pages/auth/reset')
            },
            {
                path: '/register',
                name: 'register',
                component: require('./pages/auth/register')
            }
        ]
    },
    {
        path: '/home',
        component: Dashboard,
        beforeEnter: requireAuth, // axios中已经对401进行了处理，但为了更流畅，此处提前简单验证
        children: [
            {
                path: '/',
                name: 'home',
                component: require('./pages/Home.vue'),
            },
            {
                path: '*',
                redirect: '/home'
            }
        ]
    }
]

function requireAuth(to, from, next) {
    if (localStorage.getItem('token')) {
        return next()
    } else {
        return next('/login')
    }
}


function guest(to, from, next) {
    if (localStorage.getItem('token')) {
        return next('/home')
    } else {
        next()
    }
}