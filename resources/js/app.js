import './bootstrap';
import metisMenu from 'metismenu';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';


//import boostrap

import { createApp } from 'vue'

import Test from './components/test.vue'

//Usuarios
import UserList from './components/Users/UserList.vue'

const app = createApp({})

app.component('test', Test)
app.component('user-list', UserList)

app.mount('#app')
