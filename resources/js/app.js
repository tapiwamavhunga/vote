/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform';
import VueRouter from 'vue-router'
import moment from 'moment';
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import wysiwyg from "vue-wysiwyg";
import "vue-wysiwyg/dist/vueWysiwyg.css"; 

import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);

Vue.use(VueRouter)
Vue.use(Vuetify)
Vue.use(wysiwyg, {});
const opts = {}
export default new Vuetify(opts)

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('pagination', require('laravel-vue-pagination'));

import Swal from 'sweetalert2'
window.Swal = Swal;


const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
window.Toast = Toast;

import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '12px'
})

let routes = [
  { path: '/', component: require('./components/Dash.vue').default },
  { path: '/notification', component: require('./components/Notification.vue').default },
  { path: '/voters', component: require('./components/Voters.vue').default },
  { path: '/candidates', component: require('./components/Candidates.vue').default },
  { path: '/home', component: require('./components/Dash.vue').default },
  { path: '/dashboard', component: require('./components/Dash.vue').default },
  { path: '/users', component: require('./components/Users.vue').default },
  { path: '/profile', component: require('./components/Profile.vue').default },
  { path: '/signup', component: require('./components/Reg.vue').default }, 
]

const router = new VueRouter({
  // mode: 'history',
  routes,
})

Vue.filter('myDate', function (created) {
  return moment(created).format('MMMM Do YYYY HH:mm:ss');
});

window.Fire = new Vue();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue 
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('login-component', require('./front/Login.vue').default);
Vue.component('voting-component', require('./components/Voting.vue').default);
Vue.component('wait-component', require('./components/Wait.vue').default);
Vue.component('dashboard-component', require('./components/Dashboard.vue').default);
Vue.component('user-component', require('./components/Users.vue').default);
Vue.component('profile-component', require('./components/Profile.vue').default);
Vue.component('reg-component', require('./components/Reg.vue').default);  
// Vue.component('not-found', require('./components/NotFound.vue').default); 

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
  el: '#app',
  vuetify: new Vuetify(),
  router,
  data: {
    search: '',
  },
  methods: {
    searchit: _.debounce(() => {
      Fire.$emit('searching');
    }, 1000),
  },
});
