// 📄 app.ts

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

import '../css/app.css'

import { resolvePage } from './config/resolvePage'
import { getLayoutForPage } from './config/layoutConfig'

createInertiaApp({
  resolve: async (name) => {
    const page = await resolvePage(name)
    page.layout = getLayoutForPage(name)
    
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