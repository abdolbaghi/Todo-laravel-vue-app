import './bootstrap';

import { createApp } from 'vue';
import Home from './vue/app.vue';
import Calendar from './vue/calendar.vue';
import addItemForm from './vue/addItemForm.vue';
import calendarDay from './vue/calendarDay.vue';
import listView from './vue/listView.vue';
import { library } from "@fortawesome/fontawesome-svg-core"
import { faPlusSquare, faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
const routes = [
    { path: '/', component: Home },
    { path: '/cal', component: Calendar },
  ]
  
  // 3. Create the router instance and pass the `routes` option
  // You can pass in additional options here, but let's
  // keep it simple for now.
  const router = VueRouter.createRouter({
    // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
    history: VueRouter.createWebHashHistory(),
    routes, // short for `routes: routes`
  })
  
  // 5. Create and mount the root instance.

library.add(faPlusSquare, faTrash)


import Vue3PersianDatetimePicker from 'vue3-persian-datetime-picker'
const app = createApp({})
app.component('addItemForm', addItemForm)
app.component('listView', listView)
app.component('calendarDay', calendarDay)


app.use(router)
    .component('font-awesome-icon', FontAwesomeIcon)
    .component('DatePicker', Vue3PersianDatetimePicker)
    .mount('#app');


    