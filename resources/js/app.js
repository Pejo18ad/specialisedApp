/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform'

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import moment from 'moment';
import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import swal from 'sweetalert2'
window.Swal = swal;


const toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});

window.toast = toast;

import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '3px'
})




let routes = [
    { path: '/timeregistration', component: require('./components/Timeregistration.vue').default },
    { path: '/addWorkDay', component: require('./components/AddWorkDay.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/developer', component: require('./components/Developer.vue').default },
    { path: '/employeesSupervisor', component: require('./components/EmployeesSupervisor.vue').default },
    { path: '/approvalsAdmin', component: require('./components/ApprovalsAdmin.vue').default },
    //{ path: '/approvalsSupervisor', component: require('./components/ApprovalsSupervisor.vue').default },
    { path: '/approvals', component: require('./components/Approvals.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/timeregistrationAdmin', component: require('./components/TimeregistrationAdmin.vue').default },
    { path: '/timeregistrationSupervisor', component: require('./components/TimeregistrationSupervisor.vue').default },
    { path: '/employeesAdmin', component: require('./components/EmployeesAdmin.vue').default }
    
  ]

  const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  })

  Vue.filter('upText', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1);
  });

  Vue.filter('myDate', function(mydate){
    if (mydate !== null) {
      return moment(mydate).format('MM-DD-YYYY');
    }});

  Vue.filter('myTime', function(myTime){
    if (myTime !== null) {
      return moment(myTime).format('H HH:m mm');
    }});

 

 
  window.Fire = new Vue();
  
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component(
  'passport-clients',
  require('./components/passport/Clients.vue').default
);

Vue.component(
  'passport-authorized-clients',
  require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
  'passport-personal-access-tokens',
  require('./components/passport/PersonalAccessTokens.vue').default
);


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('pagination', require('laravel-vue-pagination').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
