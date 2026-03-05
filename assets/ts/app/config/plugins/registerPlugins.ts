// 📄 app/config/plugins/registerPlugins.ts

import type { App, Plugin } from 'vue';

export const registerPlugins = (app: App, inertiaPlugin: Plugin): void => {
  app.use(inertiaPlugin);
};
