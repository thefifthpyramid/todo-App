import './bootstrap';

import {createApp} from 'vue'

import ViewUIPlus from 'view-ui-plus'

import 'view-ui-plus/dist/styles/viewuiplus.css'

import router from "./router.js";

import dashbord from './vuejs/layout/app.vue'

// spinners
import LodarComponent from "./vuejs/component/spinners.vue"


var App = createApp(dashbord)

App.component('lodaer-component', LodarComponent)

//emitter
import Emitter from 'tiny-emitter'
window.emitter = new Emitter()

App.use(router)
App.use(ViewUIPlus)
App.mount('#app')


