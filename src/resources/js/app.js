import './bootstrap';

import { createApp } from 'vue';
import App from './vue/app.vue';
import { library } from "@fortawesome/fontawesome-svg-core"
import { faPlusSquare, faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
library.add(faPlusSquare, faTrash)


import Vue3PersianDatetimePicker from 'vue3-persian-datetime-picker'

export const eventBus = createApp(App);

createApp(App).component('font-awesome-icon', FontAwesomeIcon)
    .component('DatePicker', Vue3PersianDatetimePicker)
    .mount('#app');


    