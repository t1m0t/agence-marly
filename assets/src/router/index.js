import { createWebHistory, createRouter } from 'vue-router'

import protectedRoutes from './components/beforeEach/protectedRoutes.js'
import addHeadMetas from './components/beforeEach/addHeadMetas.js'

import authRoutes from './modules/auth'
import baseRoutes from './modules/base'
import appRoutes from './modules/app'
import legalRoutes from './modules/legal.js'
import userRoutes from './modules/user.js'

import pagesIndex from '../components/pages/index'

import FooterLayout from '../components/layouts/FooterLayout.vue'

const routes = [
  ...baseRoutes,
  ...authRoutes,
  ...appRoutes,
  ...legalRoutes,
  ...userRoutes
]

const router = createRouter({
  history: createWebHistory(),
  routes,
  components: {
    default: pagesIndex.base.IndexPage,
    footer: FooterLayout
  }
})

router.beforeEach(protectedRoutes)
router.beforeEach(addHeadMetas)

export default router
