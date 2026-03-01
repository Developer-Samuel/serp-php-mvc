// 📄 app/config/layout/registerLayout.ts

import type { DefineComponent } from 'vue'
import Layout from '@/ts/layout/App.vue'

export const registerLayout = (page: DefineComponent) => {
  page.layout = Layout
  return page
}