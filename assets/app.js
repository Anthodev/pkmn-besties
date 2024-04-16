import "./app.css";

import { createApp } from 'vue';
import router from './router';

import AppLayout from './layouts/App.vue'

console.log("Happy coding !!");

const app = createApp(AppLayout)
app.use(router)
app.mount('#app')
router.push('/')
