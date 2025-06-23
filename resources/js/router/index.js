import { createRouter, createWebHistory } from 'vue-router'
const AgendaIndex   = ()=> import('../views/agenda/Index.vue');
const AgendaCreate = ()=> import('../views/agenda/Create.vue');
const AgendaEdit   = ()=> import('../views/agenda/Edit.vue');

export const routes = [
    {
        path: '/',
        redirect: 'admin/agenda-index'
    },
    {
        path: '/admin/agenda-index',
        name: 'admin.agenda.index',
        component:AgendaIndex
    },
    {
        path: '/admin/agenda-create',
        name: 'admin.agenda.create',
        component:AgendaCreate
    },
    {
        path: '/admin/agenda-edit/:id',
        name: 'admin.agenda.edit',
        component:AgendaEdit
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
