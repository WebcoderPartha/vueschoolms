import {createRouter, createWebHistory} from 'vue-router'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'login',
            component:()=> import('../components/Auth/Login.vue'),
        },
        {
            path: '/register',
            name: 'register',
            component:()=> import('../components/Auth/Register.vue')
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component:()=> import('../components/Dashboard.vue')
        },
        {
            path: '/classes',
            name: 'classes',
            component:()=> import('../components/Class/index.vue')
        },
        {
            path: '/classes/edit/:id',
            name: 'edit_class',
            component:()=> import('../components/Class/EditClass.vue')
        },
        {
            path: '/year',
            name: 'year',
            component:()=> import('../components/Year/index.vue')
        },
        {
            path: '/year/edit/:id',
            name: 'edit_year',
            component:()=> import('../components/Year/EditYear.vue')
        },
        {
            path: '/year/add',
            name: 'add_year',
            component:()=> import('../components/Year/AddYear.vue')
        },


    ]

});

export default router;