// 📄 app/config/plugins/registerPlugins.ts

import type { App } from 'vue'

export const registerPlugins = (app: App, inertiaPlugin: any) => {
  app.use(inertiaPlugin)
}