import axios from 'axios';
window.axios = axios;

// import 'cropperjs/dist/cropper.css';
import Cropper from 'cropperjs';

window.Cropper = Cropper;

// import sweetalert2
import Swal from 'sweetalert2';
window.Swal = Swal;

// Set default headers for axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
