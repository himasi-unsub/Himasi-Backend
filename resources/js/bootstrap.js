import axios from 'axios';
window.axios = axios;

// import 'cropperjs/dist/cropper.css';
import Cropper from 'cropperjs';

window.Cropper = Cropper;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
