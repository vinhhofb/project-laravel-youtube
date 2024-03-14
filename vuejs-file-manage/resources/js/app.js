import './bootstrap';
import { createApp } from 'vue';
import router from './router'

import App from './layouts/App.vue';
createApp(App).use(router).mount("#app")
// const app = createApp({});

// import ExampleComponent from './components/ExampleComponent.vue';
// import FormInfo from './pages/FormInfo.vue';
// app.component('example-component', ExampleComponent);
// app.component('form-info', FormInfo);

// app.mount('#app');
