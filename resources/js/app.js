import './bootstrap';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';
import 'admin-lte/dist/js/adminlte'
import { createApp } from 'vue/dist/vue.esm-bundler';
import { createRouter, createWebHistory } from 'vue-router';
import Routes from './route.js';


const app = createApp({

});


const router = createRouter({
    routes : Routes,
    history: createWebHistory(),
});

app.use(router);

app.mount('#app');
