import { createRouter, createWebHistory } from 'vue-router'
import axiosInstance from '@/plugins/axios'
import { useAuthStore } from '@/stores/auth-store'
import { createAcl, defineAclRules } from 'vue-simple-acl'

const simpleAcl = createAcl({})
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/admin/dashboard',
      name: 'dashboard',
      component: () => import('../views/Admin/DashboardView.vue'),
      meta: {
        requiresAuth: true,
        role: 'admin'
      }
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/Admin/Auth/LoginView.vue')
    },
    {
      path: '/',
      name: 'home',
      component: () => import('../views/Web/HomeView.vue')
    },
    {
      path: '/post',
      name: 'post',
      component: () => import('../views/Web/Post/ListView.vue')
    }
  ],
  linkExactActiveClass: 'bg-danger text-white border-bottom',
})

router.beforeEach(async (to, from, next) => {
  const publicPages = ['/']
  const authRequired = !publicPages.includes(to.path)
  const store = useAuthStore()

  try {
    const { data } = await axiosInstance.get('/me')

    store.isAuthenticated = true
    store.user = data.data

    store.permissions = data.data.permissions.map((item: any) => item.name)
    store.roles = data.data.roles.map((item: any) => item.name)

    const rules = () =>
      defineAclRules((setRule) => {
        store.permissions.forEach((permission: string) => {
          setRule(permission, () => true)
        })
      })

    simpleAcl.rules = rules()
  } catch (error) {
    /* empty */
  }

  if (authRequired && !store.isAuthenticated) {
    next()
    
  } else {
    next()
  }
})

export default { router, simpleAcl }


// import { createWebHistory, createRouter } from 'vue-router'
// import HomePage from '@/views/Web/HomeView.vue';

// const routes = [
//   {
//     path: '/',
//     name: 'home',
//     component: HomePage
//   },
  // {
  //   path: '/about',
  //   name: 'about',
  //   // route level code-splitting
  //   // this generates a separate chunk (about.[hash].js) for this route
  //   // which is lazy-loaded when the route is visited.
  //   component: () => import(/* webpackChunkName: "about" */ '@/views/AboutPage.vue')
  // },
  // {
  //   path: '/login',
  //   name: 'login',
  //   component: () => import('@/views/LoginPage.vue')
  // },
  // {
  //   path: '/register',
  //   name:'register',
  //   component: () => import('@/views/RegisterPage.vue')
  // },
  // {
  //   path: '/dashboard',
  //   name: 'dashboard',
  //   component: () => import('@/views/DashboardPage.vue')
  // },


// ]

// const router = createRouter({
//   history: createWebHistory(),
//   routes,
//   linkExactActiveClass: 'bg-danger text-white border-bottom',
// })

// export default router;
