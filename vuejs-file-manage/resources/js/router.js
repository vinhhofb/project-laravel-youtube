import { createWebHistory, createRouter } from "vue-router";
import home from './pages/Home.vue';
import forderCreate from './pages/Forder/Create.vue';
import fileList from './pages/Forder/ListFile.vue';
import forderEdit from './pages/Forder/Edit.vue';
import fileSearch from './pages/File/Search.vue';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: home,
        meta: { title: 'File Manage' }
    },
    {
        path: '/forders/create',
        name: 'ForderCreate',
        component: forderCreate,
        meta: { title: 'Forder Create' }
    },
    {
        path: '/forders/edit/:id',
        name: 'ForderEdit',
        component: forderEdit,
        meta: { title: 'Forder Edit' }
    },
    {
        path: '/forders/:id',
        name: 'FileList',
        component: fileList,
        meta: { title: 'File List' }
    },
    {
        path: '/file/search',
        name: 'FileSearch',
        component: fileSearch,
        meta: { title: 'File Search' }
    }
];
const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
