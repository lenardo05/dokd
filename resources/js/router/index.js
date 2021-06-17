import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import Register from '../pages/Register';
import Login from '../pages/Login';

import Users from '../components/user/Users';
import AddUser from '../components/user/AddUser';
import EditUser from '../components/user/EditUser';


export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'users',
        path: '/users',
        component: Users
    },
    {
        name: 'adduser',
        path: '/user/add',
        component: AddUser
    },
    {
        name: 'edituser',
        path: '/user/edit/:id',
        component: EditUser
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
