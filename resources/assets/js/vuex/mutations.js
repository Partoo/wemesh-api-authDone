export const SWITCH_SIDEBAR = state => {
    return state.sidebarCollapsed = !state.sidebarCollapsed
};

export const GET_WEATHER = (state, data) => {
    return state.weather = data
};

export const LOGIN = (state, data) => {
    window.localStorage.setItem('token', JSON.stringify(data.access_token));
    window.location.href = '/home'
};
export const LOGOUT = () => {
    localStorage.removeItem('token');
    window.location.href = '/login'
};
export const STORE_ME = (state, data) => {
    return state.myInfo = data
};
export const REFRESH_TOKEN = (state, token) => {
    window.localStorage.setItem('token', JSON.stringify(token.access_token));
    window.location.reload()
};