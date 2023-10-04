


import Home from './vue/app.vue';
import Calendar from './vue/calendar.vue';
import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    { path: '/', component: Home, name:"/" },
    { path: '/cal', component: Calendar, name:"cal" },
  ]
//   process.env.BASE_URL
export const router = createRouter({
    history: createWebHistory(),
    routes
  })