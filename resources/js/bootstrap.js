import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Configura Axios
window.axios.defaults.withCredentials = true; // Permite enviar cookies
window.axios.defaults.withXSRFToken = true;
// // Obtiene el token del meta tag
// const csrfToken = document.head.querySelector('meta[name="csrf-token"]');
// if (csrfToken) {
//     window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken.content; // ¡Ojo al nombre!
// } else {
//     console.error('CSRF token no encontrado');
// }