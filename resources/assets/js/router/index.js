import Vue from 'vue';
import Router from 'vue-router';

// Containers
import Full from '../containers/Full';

// Views
import Dashboard from '../views/Dashboard';

// Views - Icons
import FontAwesome from '../views/icons/FontAwesome';
import SimpleLineIcons from '../views/icons/SimpleLineIcons';

// Views - Pages
import Page404 from '../views/pages/Page404';
import Page500 from '../views/pages/Page500';
import Login from '../views/pages/Login';
import Register from '../views/pages/Register';

// Views - Modules
import TipsNTrik from '../views/modules/master/TipsNTrik';

Vue.use(Router);

export default new Router({
  mode: 'hash', // hash or hash = Demo is living in GitHub.io, so required!
  linkActiveClass: 'open active',
  scrollBehavior: () => ({ y: 0 }),
  routes: [
    {
      path: '/',
      redirect: '/dashboard',
      name: 'Home',
      component: Full,
      children: [
        {
          path: 'dashboard',
          name: 'Dashboard',
          component: Dashboard
        },
        {
          path: 'master',
          redirect: '/master/mititi',
          name: 'Master',
          component: {
            render (c) { return c('router-view'); }
          },
          children: [
            {
              path: 'mititi',
              name: 'Tips N Trik',
              component: TipsNTrik
            }
          ]
        }
      ]
    },
    {
      path: '/pages',
      redirect: '/pages/404',
      name: 'Pages',
      component: {
        render (c) { return c('router-view'); }
      },
      children: [
        {
          path: '404',
          name: 'Page404',
          component: Page404
        },
        {
          path: '500',
          name: 'Page500',
          component: Page500
        },
        {
          path: 'login',
          name: 'Login',
          component: Login
        },
        {
          path: 'register',
          name: 'Register',
          component: Register
        }
      ]
    }
  ]
});
