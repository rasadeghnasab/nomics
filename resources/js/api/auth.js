export default {
    login(data) {
        return axios.post('auth/login', data);
    },

    saveAuthorizedUser(token) {
        localStorage.setItem('token', token);
    },

    logout() {
        return axios.post('auth/logout');
    },

    clearAuthorizedUser() {
        localStorage.removeItem('token');
    },

    authenticated() {
        return localStorage.getItem('token') != null;
    },
}
