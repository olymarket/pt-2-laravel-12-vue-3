import { createRouter, createWebHistory } from 'vue-router'
const agendaHome   = ()=> import('../views/agenda/Home.vue');
const agendaCreate = ()=> import('../views/agenda/Create.vue');
const agendaEdit   = ()=> import('../views/agenda/Edit.vue');

export const routes = [
    {
        path: '/',
        redirect: '/agenda-index'
    },
    {
        name:'agendaHome',
        path:'/agenda-index',
        component:agendaHome
    },
    {
        name:'agendaCreate',
        path:'/agenda-create',
        component:agendaCreate
    },
    {
        name:'agendaEdit',
        path:'/agenda-edit/:id',
        component:agendaEdit
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
