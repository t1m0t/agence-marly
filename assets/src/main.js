import { createApp } from 'vue'
import 'bulma/css/bulma.css'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import axios from 'axios'
import VueAxios from 'vue-axios'
import { VueCookieNext } from 'vue-cookie-next'
import App from './App.vue'
import router from './router/index.js'
import mitt from 'mitt';

const emitter = mitt();

import NavbarStart from './components/nav/elements/NavbarStart.vue'

const app = createApp(App)

// has to be imported globally for scope purpose
app.component('NavbarStart', NavbarStart)
app.component('FontAwesomeIcon', FontAwesomeIcon)

app.provide('axios', app.config.globalProperties.axios)
app.provide('emitter', emitter)

app.use(VueAxios, axios)
app.use(VueCookieNext)
app.use(router)
app.use(emitter)

app.mount('#app')
