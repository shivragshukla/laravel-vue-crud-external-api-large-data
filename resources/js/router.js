import { createRouter, createWebHistory } from 'vue-router'

import Property from './components/property.vue';
import PropertyForm from './components/propertyForm.vue';

const routes = [
  { 
    path: '/', 
    name: 'Property',
    component: Property 
  },
  {
    name: 'create',
    path: '/create',
    component: PropertyForm
  },
  {
    name: 'edit',
    path: '/edit/:id',
    component: PropertyForm
  },
]

const router = createRouter({
  history:  createWebHistory(),
  routes
});

export default router;
