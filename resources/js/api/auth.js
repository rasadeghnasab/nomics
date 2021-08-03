export default {
    login(data) {
        return axios.post('login', data);
    },

    saveAuthorizedUser(token) {
        localStorage.setItem('token', token);
    },

    logout() {
        this.authenticateTheRequest();

        console.log('get token', localStorage.getItem('token'))

        return axios.post('logout');
    },

    clearAuthorizedUser() {
        localStorage.removeItem('token');
    },

    authenticated() {
        return localStorage.getItem('token') != null;
    },

    authenticateTheRequest() {
        axios.interceptors.request.use((config) => {
            const token = localStorage.getItem('token');

            if (this.authenticated()) {
                config.headers.Authorization = `Bearer ${token}`;
            }

            return config;
        });
    }

}
