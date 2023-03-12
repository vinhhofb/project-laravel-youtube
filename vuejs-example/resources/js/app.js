import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import Home from './pages/Home.vue';
app.component('example-component', ExampleComponent);
app.component('home', Home);

app.mount('#app');
