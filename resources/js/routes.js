import Users from './components/admin/users/users';
import UserForm from './components/admin/users/user_form';

export const routes = [
  {
    name: 'users',
    path: '/users',
    component: Users
  },
  {
    name: 'user_form',
    path: '/users/create',
    component: UserForm
  },
  {
    name: 'user_form',
    path: '/users/:id',
    component: UserForm
  }
];