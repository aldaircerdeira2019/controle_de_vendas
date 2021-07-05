require('./bootstrap');

window.Vue = require('vue').default;

import App from './views/main/App';
import router from './router/index';
import Toastr from './plugin/vue-toastr';

Vue.prototype.$acl = false;

const app = new Vue({
  el: '#app',
  components: { App },
  router,
  Toastr
});
