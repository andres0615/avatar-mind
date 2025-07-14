import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Configura Axios
window.axios.defaults.withCredentials = true; // Permite enviar cookies
window.axios.defaults.withXSRFToken = true;