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
        {
            path: '/group',
            name: 'group',
            component:()=> import('../components/Group/GroupList.vue')
        },
        {
            path: '/group/edit/:id',
            name: 'edit_group',
            component:()=> import('../components/Group/EditGroup.vue')
        },
        {
            path: '/group/add',
            name: 'add_group',
            component:()=> import('../components/Group/AddGroup.vue')
        },
        {
            path: '/shift',
            name: 'shift',
            component:()=> import('../components/Shift/ShiftList.vue')
        },
        {
            path: '/shift/edit/:id',
            name: 'edit_shift',
            component:()=> import('../components/Shift/ShiftEdit.vue')
        },
        {
            path: '/shift/add',
            name: 'add_shift',
            component:()=> import('../components/Shift/ShiftAdd.vue')
        },
        {
            path: '/exam/type',
            name: 'examtype',
            component:()=> import('../components/ExamType/ExamTypeList.vue')
        },
        {
            path: '/exam/type/edit/:id',
            name: 'edit_examtype',
            component:()=> import('../components/ExamType/ExamTypeEdit.vue')
        },
        {
            path: '/exam/type/add',
            name: 'add_examtype',
            component:()=> import('../components/ExamType/ExamTypeAdd.vue')
        },
        {
            path: '/subject',
            name: 'subject',
            component:()=> import('../components/Subject/SubjectList.vue')
        },
        {
            path: '/subject/edit/:id',
            name: 'edit_subject',
            component:()=> import('../components/Subject/SubjectEdit.vue')
        },
        {
            path: '/subject/add',
            name: 'add_subject',
            component:()=> import('../components/Subject/SubjectAdd.vue')
        },

        {
            path: '/assign/subject',
            name: 'assignsubject',
            component:()=> import('../components/AssignSubject/AssignSubjectList.vue')
        },
        {
            path: '/assign/subject/edit/:id',
            name: 'edit_asssub',
            component:()=> import('../components/AssignSubject/AssignSubjectEdit.vue')
        },
        {
            path: '/assign/subject/add',
            name: 'add_assignsubject',
            component:()=> import('../components/AssignSubject/AssignSubjectAdd.vue')
        },


    ]

});

export default router;