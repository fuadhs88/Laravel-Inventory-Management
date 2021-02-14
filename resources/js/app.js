
require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue'      
import VueRouter from 'vue-router'
Vue.use(VueRouter)


//----route imported-------
import {routes} from './routes';


//---import User Class----
import User from './helpers/User';
window.User = User                 


//----import Notification Class-------
import Notification from './helpers/Notification';  
window.Notification = Notification


//----start-----Sweetalert2------
import Swal from 'sweetalert2'
window.Swal = Swal              

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

window.Toast = Toast;      
//----End-----Sweetalert2------------//------


//------Reload-----
window.Reload = new Vue();  


const router = new VueRouter({ 
    routes,
    mode: 'history'    
})

const app = new Vue({
    el: '#app',
    router         
});
