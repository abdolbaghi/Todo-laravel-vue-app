import './bootstrap';

import { createApp } from 'vue';
import { library } from "@fortawesome/fontawesome-svg-core"
import { faPlusSquare, faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {router} from './router'
import App from './app.vue';


library.add(faPlusSquare, faTrash)


import Vue3PersianDatetimePicker from 'vue3-persian-datetime-picker'
const app = createApp(App)


app.use(router)
    .component('font-awesome-icon', FontAwesomeIcon)
    .component('DatePicker', Vue3PersianDatetimePicker)
    .mount('#app');


    