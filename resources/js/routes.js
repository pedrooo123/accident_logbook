import AllLogs from './components/AllLogs.vue';
import CreateLog from './components/CreateLog.vue';
import EditLog from './components/EditLog.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllLogs
    },
    {
        name: 'create',
        path: '/create',
        component: CreateLog
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditLog
    }
];
