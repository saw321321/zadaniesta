import { createRouter, createWebHistory } from 'vue-router';
import VueRouter from 'vue-router'

const routes = [
  // Twoje trasy tutaj
];
export default new VueRouter({
  routes,
  mode: 'history'
})
const router = createRouter({
  history: createWebHistory(),
  routes,
});


