/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import Form from 'vform'
 import moment from 'moment';
//import{Form, HasError, AlertError} from 'vform';
import {
  Button,
  HasError, 
  AlertError,
  AlertErrors,
  AlertSuccess
} from 'vform/src/components/bootstrap4'

window.Form = Form;

Vue.component(Button.name, Button)
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertErrors.name, AlertErrors)
Vue.component(AlertSuccess.name, AlertSuccess)
//sweet alert


import swal from 'sweetalert2';
window.swal = swal;
window.Toast = swal;
const Toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})


//sweet alert


import Vue from 'vue';


import VueRouter from 'vue-router';

Vue.use(VueRouter)

import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '3px'    
})

let routes = [
    { path: '/dashboard', component:  require('./components/dashboard.vue').default },
    { path: '/AdministradorUsuario', component:  require('./components/AdministradorUsuario.vue').default },
    { path: '/Users', component:  require('./components/Users.vue').default },
    { path: '/profile', component:  require('./components/profile.vue').default},
    { path: '/Pasiente', component:  require('./components/Pasiente.vue').default}
  ]

  const router = new VueRouter({
    mode:'history',
    routes // short for `routes: routes`
  })

  
  Vue.filter('upText', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1)
  })
  
  Vue.filter('mydate', function(created){

    return moment(created).format('MMMM Do YYYY, h:mm:ss a'); // November 8th 2021, 9:17:22 am
  })
//  para hacer un request cada ves que se cree un usuario 
  window.Fire = new Vue();
//
  
  

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
  el: '#app',
  router
});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


