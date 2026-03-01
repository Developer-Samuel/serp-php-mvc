// 📄 app/bootstrap.ts

import { createInertiaApp } from '@inertiajs/vue3'
import { createApp, h } from 'vue'

import '@/css/app.css'

import { resolvePage } from '@/ts/app/config/inertia/resolvePage'
import { registerLayout } from '@/ts/app/config/layout/registerLayout'
import { registerPlugins } from '@/ts/app/config/plugins/registerPlugins'

createInertiaApp({
  resolve: async (name: string) => {
    const page = await resolvePage(name)
    return registerLayout(page)
  },

  setup({ el, App, props, plugin }) {
    const app = createApp({
      render: () => h(App, props),
    })

    registerPlugins(app, plugin)

    app.mount(el)
  },
})