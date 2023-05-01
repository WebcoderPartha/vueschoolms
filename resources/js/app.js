
import './bootstrap';
import { createApp } from 'vue';
import router from "./router";
import Main from "./components/Main.vue";
import Swal from "sweetalert2";
import Notification from "./helpers/Notification";
import axios from "axios";
import User from "./helpers/User";

// Sweet Alert
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    },
    customClass: {
        title: 'sweet_titleImportant',
    }
})
window.Swal = Swal;
axios.defaults.baseURL = 'http://localhost:8000/api';
// Authorization Bearer Token
axios.defaults.headers.common['Authorization'] = 'Bearer '+localStorage.getItem('token');


window.Toast = Toast
window.Notification = Notification;
// End Sweet Alert
window.User = User

const app = createApp(Main);





app.use(router)
app.mount('#app');
