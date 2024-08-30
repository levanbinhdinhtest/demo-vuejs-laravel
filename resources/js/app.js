import './bootstrap';
import { createApp } from 'vue';
import router from '../routes/index';
import {Menu,List,Drawer,Button, message,Card,Table ,Avatar,Select,Input,Checkbox,Modal} from 'ant-design-vue';
import 'ant-design-vue/dist/reset.css';
import 'bootstrap/dist/css/bootstrap-grid.min.css'
import 'bootstrap/dist/css/bootstrap-utilities.min.css'
import axios from 'axios'
window.axios = axios;
import { createPinia } from 'pinia'
import App from './App.vue';
const app = createApp(App);
const pinia = createPinia()
app.use(router);
app.use(Button);
app.use(Drawer);
app.use(List);
app.use(Menu);
app.use(Card);
app.use(Table);
app.use(pinia);
app.use(Avatar);
app.use(Select);
app.use(Input);
app.use(Checkbox);
app.use(Modal);
app.mount("#app");
app.config.globalProperties.$message = message;
