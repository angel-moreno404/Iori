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

import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);
Vue.component('pagination', require('laravel-vue-pagination'));Vue.component('pagination', require('laravel-vue-pagination'));

window.Form = Form;

Vue.component(Button.name, Button)
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertErrors.name, AlertErrors)
Vue.component(AlertSuccess.name, AlertSuccess)
//sweet alert
Vue.prototype.$userInfo = JSON.parse(document.querySelector("meta[name='user_info']").getAttribute('content'));

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
    { path: '/Pasiente', component:  require('./components/Pasiente.vue').default},
    { path: '/Almacen', component:  require('./components/Almacen.vue').default},
    { path: '/Movimientos', component:  require('./components/Movimientos.vue').default},
    { path: '/Antecedentes', component:  require('./components/Antecedentes.vue').default},
    { path: '/HistorialM', component:  require('./components/HistorialM.vue').default},
    { path: '/HistorialC', component:  require('./components/HistorialC.vue').default},
    { path: '/Facturacion', component:  require('./components/Facturacion.vue').default},
    { path: '/RecepcionP', component:  require('./components/RecepcionP.vue').default},
    { path: '/CronogramaCitas', component:  require('./components/CronogramaCitas.vue').default},
    { path: '/GestorPaciente', component:  require('./components/GestorPaciente.vue').default},
    //{ path: '*', component:  require('./components/NotFound.vue').default}
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
  window.Boom = new Vue();
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

Vue.component(
  'not-found', require('./components/NotFound.vue').default
);

const app = new Vue({
  el: '#app',
  router,
  data(){
return {

  search:''
  
}
     
  },

  methods:{

    searchit: _.debounce(()=> {

      console.log("searching . . .");
      Fire.$emit("searching");
    },1000),

   
    

  }


});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


