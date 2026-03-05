// 🧰 eslint.config.mjs

import js from '@eslint/js';
import prettier from 'eslint-config-prettier';

import { ignoresConfig } from './support/tools/eslint/config/ignores.config.js';
import { typescriptPlugin } from './support/tools/eslint/plugins/typescript.js';
import { vuePlugin } from './support/tools/eslint/plugins/vue.js';

export default [
  // Config
  js.configs.recommended,
  prettier,
  ignoresConfig,

  // Plugins
  typescriptPlugin,
  vuePlugin,
];
