window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Accept'] = 'application/json';

// Add a request interceptor
window.axios.defaults.baseURL = '/api/v1/';

window.axios.interceptors.request.use((config) => {
    const token = localStorage.getItem('token');

    if (token != null) {
        config.headers.Authorization = `Bearer ${token}`;
    }

    return config;
});

