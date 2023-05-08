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

        // Assign Subject
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
        {
            path: '/assign/subject/class/:id',
            name: 'subject_deatils',
            component:()=> import('../components/AssignSubject/View.vue')
        },

        // Registration Fee
        {
            path: '/registration/fees',
            name: 'regifee',
            component:()=> import('../components/RegistrationFee/RegisterFeeList.vue')
        },
        {
            path:  '/registration/fees/edit/:id',
            name: 'edit_regifee',
            component:()=> import('../components/RegistrationFee/RegisterFeeEdit.vue')
        },
        {
            path:  '/registration/fees/add',
            name: 'add_regifee',
            component:()=> import('../components/RegistrationFee/RegisterFeeAdd.vue')
        },
        {
            path:  '/registration/fees/detail/:id',
            name: 'regifee_detail',
            component:()=> import('../components/RegistrationFee/RegisterFeeDetail.vue')
        },

        // Monthly Fee
        {
            path: '/monthly/fees',
            name: 'monthlyfee',
            component:()=> import('../components/MonthlyFee/FeeList.vue')
        },
        {
            path:  '/monthly/fees/edit/:year/:month',
            name: 'edit_monthlyfee',
            component:()=> import('../components/MonthlyFee/FeeEdit.vue')
        },
        {
            path:  '/monthly/fees/add',
            name: 'add_monthlyfee',
            component:()=> import('../components/MonthlyFee/FeeAdd.vue')
        },
        {
            path:  '/monthly/fees/detail/:year/:month',
            name: 'monthlyfee_detail',
            component:()=> import('../components/MonthlyFee/FeeDetail.vue')
        },

        // Exam Fee
        {
            path: '/exam/fees',
            name: 'examfee',
            component:()=> import('../components/ExamFee/FeeList.vue')
        },
        {
            path:  '/exam/fees/edit/:year/:exam',
            name: 'edit_examfee',
            component:()=> import('../components/ExamFee/FeeEdit.vue')
        },
        {
            path:  '/exam/fees/add',
            name: 'add_examfee',
            component:()=> import('../components/ExamFee/FeeAdd.vue')
        },
        {
            path:  '/exam/fees/detail/:year/:exam',
            name: 'examfee_datail',
            component:()=> import('../components/ExamFee/FeeDetail.vue')
        },

        // Register Student
        {
            path:  '/student/view-all',
            name: 'studentlist',
            component:()=> import('../components/ManageStudent/StudentRegister/StudentList.vue')
        },
        {
            path:  '/student/add',
            name: 'studentadd',
            component:()=> import('../components/ManageStudent/StudentRegister/AddStudent.vue')
        },
        {
            path:  '/student/edit/:id',
            name: 'studentedit',
            component:()=> import('../components/ManageStudent/StudentRegister/EditStudent.vue')
        },
        {
            path:  '/student/detail/:id',
            name: 'studentdetail',
            component:()=> import('../components/ManageStudent/StudentRegister/StudentDetail.vue')
        },

        // Roll Generate
        {
            path:  '/roll/generate',
            name: 'rollgenerate',
            component:()=> import('../components/ManageStudent/RollGenerate/RollGenerate.vue')
        },

        // Pay Registration Fee
        {
            path:  '/pay/registration/fee',
            name: 'payregifee',
            component:()=> import('../components/ManageStudent/PayRegistrationFee/PayRegistrationFeeList.vue')
        },
        {
            path:  '/pay/registration/:year/:class/:student/slip',
            name: 'payregifeeslip',
            component:()=> import('../components/ManageStudent/PayRegistrationFee/PayRegistrationFeeSlip.vue')
        },

        // Monthly Fee
        {
            path:  '/pay/monthly/fee',
            name: 'paymonthlyfee',
            component:()=> import('../components/ManageStudent/PayMonthlyFee/PayMonthlyFeeList.vue')
        },
        {
            path:  '/pay/monthly/:year/:month/:class/:student/slip',
            name: 'paymonthlyfeeslip',
            component:()=> import('../components/ManageStudent/PayMonthlyFee/MonthlyFeePaySlip.vue')
        },

        // Exam Fee Fee
        {
            path:  '/pay/exam/fee',
            name: 'payexamfee',
            component:()=> import('../components/ManageStudent/PayExamFee/PayExamFeeList.vue')
        },
        {
            path:  '/pay/exam/fee/:year/:exam/:class/:student/slip',
            name: 'payexamfeeslip',
            component:()=> import('../components/ManageStudent/PayExamFee/PayExamFeeSlip.vue')
        },

        // Grade
        {
            path:  '/mark/entry',
            name: 'markentry',
            component:()=> import('../components/ManageMark/MarkEntry/MarkEntrySearchList.vue')
        },


        // Grade
        {
            path:  '/grade/list',
            name: 'gradelist',
            component:()=> import('../components/ManageMark/Grade/GradeList.vue')
        },
        {
            path:  '/grade/add',
            name: 'gradeadd',
            component:()=> import('../components/ManageMark/Grade/AddGrade.vue')
        },
        {
            path:  '/grade/:id/edit',
            name: 'editgrade',
            component:()=> import('../components/ManageMark/Grade/GradeEdit.vue')
        },

        // Result
        {
            path:  '/result/academic-transcript',
            name: 'marksheet',
            component:()=> import('../components/Result/MarkSheetGenerate.vue')
        },
        {
            path:  '/result/search',
            name: 'resutlsearch',
            component:()=> import('../components/Result/ResultView.vue')
        },

        // Designation
        {
            path:  '/manage/employee/designation/list',
            name: 'designation',
            component:()=> import('../components/ManageEmployee/Designation/DesignationList.vue')
        },

        {
            path:  '/manage/employee/designation/edit/:id',
            name: 'designationedit',
            component:()=> import('../components/ManageEmployee/Designation/EditDesignation.vue')
        },

        // Employee
        {
            path:  '/manage/employee/list',
            name: 'employee',
            component:()=> import('../components/ManageEmployee/Employee/EmployeeList.vue')
        },

        {
            path:  '/manage/employee/edit/:id',
            name: 'editemployee',
            component:()=> import('../components/ManageEmployee/Employee/EditEmployee.vue')
        },
        {
            path:  '/manage/employee/add',
            name: 'addemployee',
            component:()=> import('../components/ManageEmployee/Employee/AddEmployee.vue')
        },


    ]

});

export default router;