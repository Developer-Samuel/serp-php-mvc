// 📄 app.ts

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

import '../css/app.css'

import { resolvePage } from './config/resolvePage'

import Layout from './Layout/App.vue';

createInertiaApp({
  resolve: async (name: string) => {
    const page = await resolvePage(name)
    page.layout = Layout
    
    return page
  },

  setup({ el, App, props, plugin }) {
    createApp({
      render: () => h(App, props),
    })
      .use(plugin)
      .mount(el)
  },
})