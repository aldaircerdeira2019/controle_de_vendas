import Vue from "vue";
import VueRouter from "vue-router";
import Home from '../views/home/Home.vue';
import Login from '../views/auth/Login';
import Register from '../views/auth/Register';
import Shopcart from '../views/shopcart/Shopcart';
import Order from '../views/order/Order';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/login',
    name: 'login',
    component: Login
  },
  {
    path: '/register',
    name: 'register',
    component: Register
  },
  {
    path: '/shopcart/:produtoId',
    name: 'shopcart',
    component: Shopcart,
    meta: { authOnly: true }
  },
  {
    path: '/pedidos',
    name: 'order',
    component: Order,
    meta: { authOnly: true }
  }
];

const router = new VueRouter({
  mode: "history",
  base: '/spa',
  routes
});

function isLoggedIn() {
  return localStorage.getItem("auth");
}

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.authOnly)) {
    if (!isLoggedIn()) {
      next({
        name: 'login',
        query: { redirect: to.fullPath }
      })
    } else {
      next()
    }
  } else {
    next()
  }
});

export default router
