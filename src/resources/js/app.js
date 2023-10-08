import './bootstrap';

import { createApp } from 'vue';
import { library } from "@fortawesome/fontawesome-svg-core"
import { faPlusSquare, faTrash, faPlusCircle } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {router} from './router'
import App from './app.vue';
// import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap and BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

library.add(faPlusSquare, faTrash,faPlusCircle)


import Vue3PersianDatetimePicker from 'vue3-persian-datetime-picker'
const app = createApp(App)


app.use(router)
    // .use(BootstrapVue)
    // .use(IconsPlugin)
    .component('font-awesome-icon', FontAwesomeIcon)
    .component('DatePicker', Vue3PersianDatetimePicker)
    .mount('#app');


    