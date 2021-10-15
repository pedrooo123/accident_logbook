import Register from './components/Register';
import Login from './components/Login';

import AllLogs from './components/AllLogs.vue';
import CreateLog from './components/CreateLog.vue';
import EditLog from './components/EditLog.vue';

export const routes = [
    { // Home page (list of logs)
        name: 'home',
        path: '/',
        component: AllLogs
    },
    { // Register page
        name: 'register',
        path: '/register',
        component: Register
    },
    { // Login page
        name: 'login',
        path: '/login',
        component: Login
    },
    { // Create log form
        name: 'create',
        path: '/create',
        component: CreateLog
    },
    { // Edit log form
        name: 'edit',
        path: '/edit/:id',
        component: EditLog
    },
];
