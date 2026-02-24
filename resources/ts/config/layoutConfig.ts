// 📄 config/layoutConfig.ts

import Layout from '../Layout/App.vue';

export function getLayoutForPage(name: string) {
  if (name.includes('Errors/')) {
    return false;
  }
  return Layout;
}