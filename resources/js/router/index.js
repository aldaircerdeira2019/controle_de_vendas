import Vue from "vue";
import VueRouter from "vue-router";
import Home from '../views/home/Home.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'home',
    component: Home
  }
];

const router = new VueRouter({
  mode: "history",
  base: '/spa',
  routes
});

export default router