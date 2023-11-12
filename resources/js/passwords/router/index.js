import { createWebHistory, createRouter } from 'vue-router'
import Home from '@/passwords/pages/Home.vue'
import PairCreate from '@/passwords/pages/pair/Create.vue'
import PairEdit from '@/passwords/pages/pair/Edit.vue'
import IdentityCreate from '@/passwords/pages/identity/Create.vue'
import IdentityEdit from '@/passwords/pages/identity/Edit.vue'
import HostCreate from '@/passwords/pages/host/Create.vue'
import HostEdit from '@/passwords/pages/host/Edit.vue'
import Privacy from '@/passwords/pages/conditions/Privacy.vue'
import Terms from '@/passwords/pages/conditions/Terms.vue'

const routes = [
  { path: '/', component: Home },

  { path: '/pairs/create', component: PairCreate },
  { path: '/pairs/:id/edit', component: PairEdit },

  { path: '/identities/create', component: IdentityCreate },
  { path: '/identities/:id/edit', component: IdentityEdit },

  { path: '/hosts/create', component: HostCreate },
  { path: '/hosts/:id/edit', component: HostEdit },

  { path: '/terms-of-service', component: Terms },
  { path: '/privacy-policy', component: Privacy },
]

const router = createRouter({
  history: createWebHistory('/passwords'),
  routes,
})

export default router
