import Vue from 'vue'
import Router from 'vue-router'

import Home from './views/Home'
import Login from './views/Login'
import Dashboard from './views/Dashboard'
import SingUp from './views/SingUp'

// Subrotas

import Overview from './components/dashboard/Overview'
import Users from './components/dashboard/Users'
import Templates from './components/dashboard/Templates'
import User from './components/dashboard/User'
import Template from './components/dashboard/Template'
import Events from './components/dashboard/Events'
import Event from './components/dashboard/Event'
import EditEvent from './components/dashboard/EditEvent'
import Inscriptions from './components/dashboard/Inscriptions'
import Inscription from './components/dashboard/Inscription'
import Preview from './components/dashboard/create/Preview'
import Create from './components/dashboard/create/Create'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.NODE_ENV === 'production' ? '/sgenit' : '/',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/dashboard',
      component: Dashboard,
      children: [
        {
          path: '',
          name: 'overview',
          component: Overview
        },
        {
          path: 'users',
          name: 'users',
          component: Users
        },
        {
          path: 'templates',
          name: 'templates',
          component: Templates
        },
        {
          path: 'preview',
          name: 'preview',
          component: Preview
        },
        {
          path: 'events',
          name: 'events',
          component: Events
        },
        {
          path: 'event/:id',
          name: 'event',
          component: Event
        },
        {
          path: 'event/:id/edit',
          name: 'editEvent',
          component: EditEvent
        },
        {
          path: 'inscriptions',
          name: 'inscriptions',
          component: Inscriptions
        },
        {
          path: 'inscription/:id',
          name: 'inscription',
          component: Inscription
        },
        {
          path: 'user/:id',
          name: 'user',
          component: User
        },
        {
          path: 'template/:id',
          name: 'template',
          component: Template
        },
        {
          path: 'create',
          name: 'create',
          component: Create
        }
      ]
    },
    {
      path: 'singUp/:id',
      name: 'singUp',
      component: SingUp
    }
  ]
})
