import { createRouter, createWebHistory } from 'vue-router';

import AppLayout from '../layouts/App.vue'
import IndexView from '../pages/Index.vue'

const routes = [
  {
    path: '/',
    name: 'app_layout',
    component: AppLayout,
    children: [
      {
        path: '',
        name: 'index',
        component: IndexView,
      },
    ]
  },
]

const router  = createRouter({
  history: createWebHistory(),
  routes: routes,
})

export default router
