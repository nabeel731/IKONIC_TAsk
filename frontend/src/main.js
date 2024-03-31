

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import './index.css'

import App from './App.vue'
import router from './router'

import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";


const app = createApp(App)

app.use(createPinia())
app.use(router)

app.mount('#app')

const options = {
    // You can set your default options here
};

app.use(Toast, options);


