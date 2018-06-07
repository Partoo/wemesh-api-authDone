export const attemptLogin = ({commit}, data) => {
    commit('LOGIN', data)
};
export const logout = ({commit}) => {
    let token = JSON.parse(window.localStorage.getItem('token'));
    commit('LOGOUT', token)
};
export const refreshToken = ({commit}, token) => commit('REFRESH_TOKEN');

export const storeMe = ({commit}, data) => {
    commit('STORE_ME', data)
};
export const switchSidebar = ({commit}) => commit('SWITCH_SIDEBAR');
export const getWeather = ({commit}, data) => commit('GET_WEATHER', data);