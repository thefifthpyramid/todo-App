import {createWebHistory,createRouter} from "vue-router";
import home from './vuejs/pages/home.vue';

//Tasks pages
import tasks from './vuejs/pages/Tasks.vue';
import Show_tasks from './vuejs/pages/Tasks/show_tsks.vue';
import create_tasks from './vuejs/pages/Tasks/create_task.vue';
import edit_task from './vuejs/pages/Tasks/edit_task.vue';
//End tasks pages

//Sub Tasks Pages
import show_subTask from './vuejs/pages/Tasks/show_subTask.vue';
import create_subTask from './vuejs/pages/Tasks/create_subTask.vue';
//End Sub Task Pages

import form from './vuejs/pages/form.vue';
import tags from './vuejs/pages/tags.vue';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: home
    },{
        path: '/tasks',
        name: 'Tasks',
        component: tasks
    },{
        path: '/Show_tasks',
        name: 'Show_tasks',
        component: Show_tasks
    },{
        path: '/create_tasks',
        name: 'create_tasks',
        component: create_tasks
    },{
        path: '/edit_task/:id',
        name: 'edit_task',
        component: edit_task,
        props: true
    },{
        path: '/show_subTask/:id',
        name: 'show_subTask',
        component: show_subTask,
        props: true
    },{
        path: '/create_subTask/:id',
        name: 'create_subTask',
        component: create_subTask,
        props: true
    },{
        path: '/form',
        name: 'Form',
        component: form
    },{
        path: '/tags',
        name: 'Tags',
        component: tags
    },
]
const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
