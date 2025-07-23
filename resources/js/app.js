import './bootstrap';
import metisMenu from 'metismenu';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';


//import boostrap

import { createApp } from 'vue'
import Test from './components/test.vue'

const app = createApp({})

app.component('test', Test)

app.mount('#app')
