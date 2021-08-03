export default {
    login(data) {
        return axios.post('login', data);
    },

    saveAuthorizedUser(token) {
        localStorage.setItem('token', token);
    },

    logout() {
        return axios.post('logout');
    },

    clearAuthorizedUser() {
        localStorage.removeItem('token');
    },

    authenticated() {
        return localStorage.getItem('token') != null;
    },
}
