import 'bootstrap/dist/css/bootstrap.min.css' // Import Bootstrap CSS
import 'bootstrap/dist/js/bootstrap.min.js'
import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import vuetify from "./plugins/vuetify"
import axios from './plugins/axios' // we will delete when in vue don't write directly
import 'uno.css'
import { configure } from 'vee-validate';

import "bootstrap/dist/js/bootstrap.js";
import 'bootstrap-icons/font/bootstrap-icons.css';

const app = createApp(App)

configure({
  validateOnInput: true
})

app.use(createPinia())
app.use(router.router)
app.use(ElementPlus)
app.use(router.simpleAcl)
app.use(vuetify)
app.config.globalProperties.$axios = axios // we will delete when in vue don't write directly

app.mount('#app')
